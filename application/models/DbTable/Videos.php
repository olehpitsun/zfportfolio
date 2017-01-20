<?php

class Model_DbTable_Videos extends Zend_Db_Table_Abstract
{
    // таблиця БД
    protected $_name = 'video';

    public function getPage($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id)->order('id DESC');
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addData($title, $text, $img_title)
    {
        $data = array(
            'title' => $title,
            'href' => $text,
            'img_title' => $img_title
        );
        $this->insert($data);

    }

    public function updateData($id, $username , $email, $website,$text)
    {

        $data = array(
            'username' => $username,
            'email' => $email,
            'website' => $website,
            'text' => $text
        );
        $this->update($data, 'id = '. (int)$id);

    }

    public  function getInfoByid($id)
    {

        $select = $this->select()->where('id =' . $id);
        $result = $this->fetchAll($select)->toArray();
        return $result;

    }

    public function deleteData($id)
    {
        $this->delete('id =' . $id);
    }

    public function deletePage($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getData()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/pagination.phtml');
        $select = $this->select()->order(' id DESC');
        $result = $this->fetchAll($select)->toArray();
        return $result;
    }

    public function getSortData($row, $sortType){

        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/pagination.phtml');
        $select = $this->select()->order(''.$row.' '.$sortType.'');
        $result = $this->fetchAll($select)->toArray();
        return $result;
    }

    public function getRandomVideoList(){

        $select = $this->select('id');
        $result = $this->fetchAll($select)->toArray();

        $rand_keys = array_rand($result, 3);

        $random_result = array();

        for($i=0; $i < 3; $i++){
            $random_result[$i] = $result[$rand_keys[$i]];
        }
        return $random_result;
    }
}
