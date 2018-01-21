<?php

class Video_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function fetch_all($where = array()){
        $this->db->select('*');
        $this->db->from('video');
        $this->db->where('is_deleted', 0);
        if($where != null){
            $this->db->where($where);
        }
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_all_pagination($limit = NULL, $start = NULL, $search = null) {
        $this->db->select('*');
        $this->db->from('video');
        $this->db->where('is_deleted', 0);
        if(!empty($search)){
            $this->db->like('title', $search);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function fetch_all_by_type($type){
        $query = $this->db->select('*')
            ->from('video')
            ->where('type', $type)
            ->where('is_deleted', 0)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_latest_videos($quantity){
        $query = $this->db->select('*')
            ->from('video')
            ->where('is_deleted', 0)
            ->order_by('created_at', 'desc')
            ->limit($quantity)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function count_all($search = null) {
        $query = $this->db->select('*')
            ->from('video')
            ->where('is_deleted', 0);
        if(!empty($search)){
            $query->like('title', $search);
        }

        return $query->get()->num_rows();
    }

    public function fetch_by_id($type, $id){
        $query = $this->db->select('*')
            ->from($type)
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function insert($type, $data){
        $this->db->set($data)
            ->insert($type);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function update($type, $id, $video){
        $this->db->set($video)
            ->where('id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function delete($type, $id){
        $this->db->set('is_deleted', 1)
            ->where('id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function count_day($where = array()) {
        if($where != NULL){
            $query = $this->db->select('*')
                ->from('video')
                ->where($where)
                ->get();
        }else{
            $query = $this->db->select('*')
                ->from('video')
                ->get();
        }

        return $query->num_rows();
    }
}