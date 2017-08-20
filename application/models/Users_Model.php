<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    # Register the user
    public function register ($full_name, $full_surname, $username, $password, $email) {

        $data = array (
            'user_name'    => $full_name,
            'user_surname'    => $full_surname,
            'user_username'    => $username,
            'user_password'     => password_hash ($password, CRYPT_BLOWFISH),
            'user_email'        => $email        
        );

        $this->db->insert ('tbl_users', $data);

        $id = $this->db->insert_id ();

        return ($id > 0) ? $id : FALSE;
    }


    # Check if the user email exists
    public function email_id ($email) {

        # The query will get the id from the email address
        $this->db->select ('user_id')
            ->where ('user_email', $email);

        # Put the results in a variable
        $result = $this->db->get ('tbl_users');

        # If there is not just ONE row, the login can't happen
        if ($result->num_rows () != 1)
            return FALSE;

        # Get the record as an array, and return the user id
        return $result->row_array ()['user_id'];

    }

    # Check that the password is correct
    public function check_password ($id, $password) {

        # The query is set
        $this->db->select ('user_password')
            ->where ('user_id', $id);

        # Put the results in a variable
        $result = $this->db->get ('tbl_users');

        # If there is not just ONE row, the login can't happen
        if ($result->num_rows () != 1)
            return FALSE;

        # Get the password since the criteria matches
        $db_pass = $result->row_array ()['user_password'];

        # Tell the user if the password is ok
        return password_verify ($password, $db_pass);

    }

    #This is done to get all the users registered EXCLUDING the one logged in.
    public function get_all_users ($exclude = NULL) {

        $this->db->select('user_ID, user_name');

        if ($exclude != NULL) {
            $this->db->where('user_id !=', $exclude);
        }

        return $this->db->get('tbl_users');
    }


    public function get_all_users_dropdown ($exclude = NULL) {

        $users = $this->get_all_users($exclude);

        $dropdown = array ();
        foreach ($users->result_array() as $user)
            $dropdown[$user['user_ID']] = $user['user_name'];

            return $dropdown;
    }

    # Retrieve the user's data
    public function get_userdata ($id) {

        # Set the query
        $this->db->select ('user_id, user_name, user_surname, user_email')
            ->where ('user_id', $id);

        # Put the results in a variable
        $result = $this->db->get ('tbl_users');

        # If there is not just ONE row, the login can't happen
        if ($result->num_rows () != 1)
            return FALSE;

        # Give the controller all the data as an array
        return $result->row_array ();
    }

    function update_users($id, $name = NULL, $surname = NULL, $email = NULL, $phone = NULL)
    {
        $update = array();

        if ($name != NULL ) $update['user_name'] = $name;
        if ($surname != NULL ) $update['user_surname'] = $surname;
        if ($email != NULL) $update['user_email'] = $email;

        if (count($update) == 0) return TRUE;

        $this->db->where('user_id', $id)
                ->update('tbl_users', $update);

        return ($this->db->affected_rows() == 1);
    }

}
