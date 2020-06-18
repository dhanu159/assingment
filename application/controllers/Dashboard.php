<?php
class Dashboard extends CI_Controller
{

    public function loadBookCategories()
    {
        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->loadBookCategories();
        if (!$result) {
            $result = "No available records";
        }
        echo json_encode($result);
    }

    public function dashBoardHome()
    {
        $this->load->view('partials/header');
        $this->load->view('user/dashboard');
        $this->load->view('partials/footer');
    }

    public function viewAddNewBook()
    {
        $this->load->view('partials/header');
        $this->load->view('book/addNewBook');
        $this->load->view('partials/footer');
    }

    public function addNewBook()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('book_title', 'Book Title', 'required');
        $this->form_validation->set_rules('year_of_publishing', 'Year of Publishing', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required|is_unique[book.ISBN]');
        $this->form_validation->set_rules('medium', 'Medium', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('book_category', 'Book Category', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('partials/header');
            $this->load->view('book/addNewBook');
            $this->load->view('partials/footer');
        } else {
            $file_extension = "";
            if (!empty($_FILES['book_image']['name'])) {
                $file_extension = $this->do_upload();
            }
            $this->load->model('Dashboard_model');
            $result = $this->Dashboard_model->addNewBook($file_extension);

            $this->load->view('partials/header');
            $this->load->view('user/dashboard', $result);
            $this->load->view('partials/footer');
        }
    }


    public function UpdateBook()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('book_title', 'Book Title', 'required');
        $this->form_validation->set_rules('year_of_publishing', 'Year of Publishing', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('medium', 'Medium', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('book_category', 'Book Category', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('partials/header');
            $this->load->view('book/updateBook');
            $this->load->view('partials/footer');
        } else {
            $file_extension = "";
            if (!empty($_FILES['book_image']['name'])) {
                $file_extension = $this->do_upload();
            }
            $this->load->model('Dashboard_model');
            $result = $this->Dashboard_model->updateBook($file_extension);

            $data = array(
                'result' => $result
            );

            $this->load->view('partials/header');
            $this->load->view('user/dashboard', $data);
            $this->load->view('partials/footer');
        }
    }

    // upload book image
    public function do_upload()
    {

        $file_extension = pathinfo($_FILES["book_image"]["name"], PATHINFO_EXTENSION);

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 1024;
        $config['max_height']           = 1024;
        $config['file_name']            = $this->input->post('isbn') . "." . $file_extension;
        $this->load->library('upload', $config);



        if (!$this->upload->do_upload('book_image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('partials/header');
            $this->load->view('book/addNewBook', $error);
            $this->load->view('partials/footer');
        } else {

            return $file_extension;
        }
    }

    public function loadBookDetails()
    {

        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->loadAllBookDetails();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
    }

    public function searchBookDetails()
    {

        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->searchBookDetails();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
    }

    public function searchBookAccordingToCategory()
    {
        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->searchBookAccordingToCategory();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
    }

    public function deleteBookDetails()
    {
        $data = array(
            'msg' => '',
            'status' => false
        );
        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->deleteBookDetails();
        if ($result) {
            $data['msg'] = 'Record deleted successfully!';
            $data['status'] = true;
        } else {
            $data['msg'] = 'Record not deleted!';
        }
        echo json_encode($data);
    }

    public function selectToUpdateBookDetails($bookID)
    {
        $data = array(
            'bookID' => $bookID
        );
        $this->load->view('partials/header');
        $this->load->view('book/updateBook', $data);
        $this->load->view('partials/footer');
    }

    public function LoadSelectedBook()
    {
        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->LoadSelectedBook();
        echo json_encode($result);
    }
}
