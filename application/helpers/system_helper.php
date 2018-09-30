<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_helper
{
    public static function upload_file($save_dir,$allowed_types='gif|jpg|png',$max_size=10240)
    {
        $CI= & get_instance();
        $CI->load->library('upload');
        $config=array();
        $config['upload_path']=$save_dir;
        $config['allowed_types']=$allowed_types;
        $config['max_size']=$max_size;
        $config['overwrite']=false;
        $config['remove_spaces']=true;

        $uploaded_files=array();
        foreach ($_FILES as $key=>$value)
        {
            if(strlen($value['name'])>0)
            {
                $CI->upload->initialize($config);
                if($CI->upload->do_upload($key))
                {
                    $uploaded_files[$key]=array('status'=>true,'info'=>$CI->upload->data());
                }
                else
                {
                    $uploaded_files[$key]=array('status'=>false,'message'=>$value['name'].': '.$CI->upload->display_errors());
                }
            }
        }
        return $uploaded_files;
    }
}
