<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Project extends CI_Controller {
 
   public function __construct() {
      parent::__construct(); 
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('Project_model', 'project');
 
   }
 
   
  /*
    View page of project
  */
  public function index()
  {
    $data['title'] = "CodeIgniter Project Manager";
    $this->load->view('projects',$data);
 
  }
 
  /*
    Get all records 
  */
  public function show_all()
  {
    $projects = $this->project->get_all();
    header('Content-Type: application/json');
    echo json_encode($projects);
  }
 
  /*
 
    Get a record
  */
  public function show($id)
  {
    $project = $this->project->get($id);
    header('Content-Type: application/json');
    echo json_encode($project);
  }
 
 
  /*
    Save the submitted record
  */
  public function store()
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
     
    if (!$this->form_validation->run())
    {
      http_response_code(412);
      header('Content-Type: application/json');
      echo json_encode([
        'status' => 'error',
        'errors' => validation_errors()
      ]);
    } else {
       $this->project->store();
       header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);
    }
 
  }
 
  /*
    Edit a record 
  */
  public function edit($id)
  {
    $project = $this->project->get($id);
    header('Content-Type: application/json');
    echo json_encode($project);   
  }
 
  /*
    Update the submitted record
  */
  public function update($id)
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
    if (!$this->form_validation->run())
    {
      http_response_code(412);
      header('Content-Type: application/json');
      echo json_encode([
        'status' => 'error',
        'errors' => validation_errors()
      ]);
    } else {
       $this->project->update($id);
       header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);
    }
 
 
  }
 
  /*
    Delete a record
  */
  public function delete($id)
  {
    $item = $this->project->delete($id);
    header('Content-Type: application/json');
    echo json_encode(['status' => "success"]);
  }
 
 
}