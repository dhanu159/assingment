<?php
class Dashboard_model extends CI_Model
{
    public function loadBookCategories()
    {
        $query = $this->db->query("SELECT * FROM book_category");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addNewBook($file_extension)
    {
        $dataAuthor = array(
            'author_name' => $this->input->post('author')
        );
        $authorId = "";
        $query = $this->db->get_where('book_author', $dataAuthor); //check if author already exist in database
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $authorId = $row['id'];
        } else {
            $this->db->insert('book_author', $dataAuthor); // if author alreay not in the database enter the autohr and get id
            $authorId = $this->db->insert_id();
        }

        $dataBook = array(
            'name' => $this->input->post('book_title'),
            'year_of_publishing' => $this->input->post('year_of_publishing'),
            'price' => $this->input->post('price'),
            'ISBN' => $this->input->post('isbn'),
            'medium' => $this->input->post('medium'),
            'id_author' => $authorId,
            'id_category' => $this->input->post('book_category')

        );
        if ($file_extension) {
            $dataBook['image'] = $this->input->post('isbn') . "." . $file_extension;
        }

        $this->db->insert('book', $dataBook);

        return "Record inserted successfully";
    }


    public function updateBook($file_extension)
    {
        $dataAuthor = array(
            'author_name' => $this->input->post('author')
        );
        $authorId = "";
        $query = $this->db->get_where('book_author', $dataAuthor); //check if author already exist in database
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $authorId = $row['id'];
        } else {
            $this->db->insert('book_author', $dataAuthor); // if author alreay not in the database enter the autohr and get id
            $authorId = $this->db->insert_id();
        }

        $dataBook = array(
            'name' => $this->input->post('book_title'),
            'year_of_publishing' => $this->input->post('year_of_publishing'),
            'price' => $this->input->post('price'),
            'ISBN' => $this->input->post('isbn'),
            'medium' => $this->input->post('medium'),
            'id_author' => $authorId,
            'id_category' => $this->input->post('book_category')

        );
        if ($file_extension) {
            $dataBook['image'] = $this->input->post('isbn') . "." . $file_extension;
        }

        $bookID = $this->input->post('bookId');
        $this->db->where('id', $bookID);
        $this->db->update('book', $dataBook);

        return "Record Updated successfully";
    }

    public function loadAllBookDetails()
    {
        $query = $this->db->query("SELECT book.id as bookId, book.name, book.price,book.image, book_author.author_name FROM book INNER JOIN book_author ON book.id_author = book_author.id");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function  searchBookDetails()
    {
        $searchBy = $this->input->post('searchBy');
        $query = $this->db->query("SELECT book.id as bookId,book.name, book.price,book.image, book_author.author_name FROM book INNER JOIN book_author ON book.id_author = book_author.id WHERE (name LIKE '$searchBy%') OR (author_name LIKE '$searchBy%')  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function  searchBookAccordingToCategory()
    {
        $book_category = $this->input->post('book_category');
        $query = $this->db->query("SELECT book.id as bookId,book.name, book.price,book.image, book_author.author_name FROM book INNER JOIN book_author ON book.id_author = book_author.id INNER JOIN book_category ON book_category.id = book.id_category WHERE book_category.category_name = '$book_category' ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function deleteBookDetails()
    {
        $bookId = $this->input->post('bookId');

        $this->db->delete('book', array('id' => $bookId));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function LoadSelectedBook()
    {
        $bookId = $this->input->post('bookId');
        $query = $this->db->query("SELECT book.id as bookId, book_category.category_name, book.medium ,book.year_of_publishing ,book.isbn , book.name, book.price,book.image, book_author.author_name FROM book INNER JOIN book_author ON book.id_author = book_author.id INNER JOIN book_category ON book.id_category = book_category.id WHERE book.id = '$bookId'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
