<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends Api_controller
{
    public function index()
    {
        $upload_site_root_dir=$this->input->post('upload_site_root_dir');
        if(!in_array($upload_site_root_dir,$this->config->item('system_allowed_sites')))
        {
            $response['status']=false;
            $response['response_message']='Invalid site';
            $this->json_return($response);
        }
        $upload_auth_key=$this->input->post('upload_auth_key');
        if(!in_array($upload_auth_key,$this->config->item('system_allowed_auth_keys')))
        {
            $response['status']=false;
            $response['response_message']='Invalid auth key';
            $this->json_return($response);
        }
        $save_dir=$this->input->post('save_dir');
        $allowed_types=$this->input->post('allowed_types');
        $max_size=$this->input->post('max_size');
        $dir=str_replace($this->config->item('system_site_root_folder'),$upload_site_root_dir,FCPATH).$save_dir;
        if(!is_dir($dir))
        {
            $status_created=mkdir($dir, 0777);
            if(!$status_created)
            {
                $response['status']=false;
                $response['response_message']='Unable to Create Directory';
                $this->json_return($response);
            }
        }
        $response['uploaded_files']= System_helper::upload_file($dir,$allowed_types,$max_size);
        $response['status']=true;
        $response['response_message']='Upload Success';
        $this->json_return($response);

    }

}
