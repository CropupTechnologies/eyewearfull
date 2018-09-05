<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Itemmodel');
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Branch_model');
        $this->load->model('Common');
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function model_fields() {
        if (isset($_SESSION['admin'])) {
            $data['title'] = 'Admin | Model Fields';
            $data['item_types'] = $this->Itemmodel->get_all_item_types(TRUE);
            $data['model_fields'] = $this->Itemmodel->get_all_master_data();
            $data['main_content'] = 'admin/model_fields';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Master Data', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function field_values($id = NULL) {
        if (isset($_SESSION['admin'])) {
            if ($id != NULL && intval($id) > 0 && intval($id) < 9999) {
                $att = $this->Itemmodel->get_attribute_by_id($id);
                if ($att != FALSE) {
                    if ($att['enabled'] == 1) {
                        $data['attribute_data'] = $att;
                        $data['title'] = 'Admin | Metadata';
                        $data['main_content'] = 'admin/field_values';
                        $this->load->view('templates/admin_template', $data);
                    } else {
                        redirect(base_url('error/page/7'));
                    }
                } else {
                    redirect(base_url('error/page/8'));
                }
            } else {
                redirect(base_url('error/page/6'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function model_fields_value() {
        if (isset($_SESSION['admin'])) {
            $model_field_id = $this->input->get('model_field');
            $data['model_field'] = $this->Itemmodel->get_model_field_name($model_field_id);
            $data['field_values'] = $this->Itemmodel->get_values_by_model_field($model_field_id);
            //$data['model_fields'] = $this->Itemmodel->get_all_master_data();
            $data['title'] = 'Admin | Model Fields Value';
            $data['main_content'] = 'admin/model_fields_value';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Model Field Values', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_attribute() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $name = $this->input->post('sub-field-name');
            $data_type = $this->input->post('data-type');
            $unit = $this->input->post('unit');
            $order_id = $this->input->post('order-id');
            $min_value = $this->input->post('min-value');
            $max_value = $this->input->post('max-value');
            $is_mandatory = $this->input->post('is-mandatory');
            if (strlen(trim($name)) > 0) {
                if ($this->Itemmodel->add_attribute(
                                $name, $data_type, $unit, $order_id, $min_value, $max_value, $is_mandatory, $_SESSION['admin']['id']
                        )) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Model Field', '');
                } else {
                    $error_no = 443;
                }
            } else {
                $error_no = 442;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_attribute() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $id = $this->input->post('attribute-id');
            $name = $this->input->post('attribute-name');
            $data_type = $this->input->post('data-type');
            $unit = $this->input->post('unit');
            $order_id = $this->input->post('order-id');
            $min_value = $this->input->post('min-value');
            $max_value = $this->input->post('max-value');
            $is_mandatory = $this->input->post('is-mandatory');
            if (strlen(trim($name)) > 0) {
                if ($this->Itemmodel->edit_attribute(
                                $id, $name, $data_type, $unit, $order_id, $min_value, $max_value, $is_mandatory, $_SESSION['admin']['id']
                        )) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Model Field', 'ID: ' . $id);
                } else {
                    $error_no = 448;
                }
            } else {
                $error_no = 442;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_attribute_value() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $att_id = $this->input->post('att-id');
            $value = $this->input->post('value');
            $dispaly_order = $this->input->post('display-order');
            if (strlen(trim($att_id)) > 0 && strlen(trim($value)) > 0 && strlen(trim($dispaly_order)) > 0) {
                if ($this->Itemmodel->add_attribute_value($att_id, $value, $dispaly_order, $_SESSION['admin']['id'])) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Field Value', 'Value: ' . $value);
                } else {
                    $error_no = 449;
                }
            } else {
                $error_no = 9;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_attribute_value() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $value_id = $this->input->post('value-id');
            $value = $this->input->post('value');
            $dispaly_order = $this->input->post('display-order');
            if (strlen(trim($value_id)) > 0 && strlen(trim($value)) > 0 && strlen(trim($dispaly_order)) > 0) {
                if ($this->Itemmodel->edit_attribute_value($value_id, $value, $dispaly_order, $_SESSION['admin']['id'])) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Field Value', 'Value: ' . $value);
                } else {
                    $error_no = 449;
                }
            } else {
                $error_no = 9;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function metadata_products() {
        if (isset($_SESSION['admin'])) {
            $data['title'] = 'Admin | Products';
            $data['products'] = $this->Product_model->get_all_metadata_products();
            $data['product_types'] = $this->Product_model->get_all_product_types(TRUE);
            $data['counting_behaviours'] = $this->Common->get_enum_values('metadata_product', 'counting_behaviour');
            $data['main_content'] = 'admin/metadata_products';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Master Data', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function models() {
        if (isset($_SESSION['admin'])) {
            $data['title'] = 'Admin | Models';
            $data['category_tree'] = $this->Category_model->get_category_tree();
            $data['models'] = $this->Itemmodel->get_all_models();
            $data['products'] = $this->Product_model->get_all_metadata_products(1);
            $data['main_content'] = 'admin/models';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Master Data', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_product() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $name = $this->input->post('product-name');
            $type = $this->input->post('product-type');
            $counting_behaviour = $this->input->post('counting-behaviour');
            $description = $this->input->post('description');
            if ($this->Product_model->add_product($name, $type, $counting_behaviour, $description, $_SESSION['admin']['id'])) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Product', 'Value: ' . $name);
            } else {
                $error_no = 449;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_product() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $id = $this->input->post('product-id');
            $name = $this->input->post('product-name');
            $type = $this->input->post('product-type');
            $counting_behaviour = $this->input->post('counting-behaviour');
            $description = $this->input->post('description');
            if ($this->Product_model->update_product($id, $name, $type, $counting_behaviour, $description, $_SESSION['admin']['id'])) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Product', 'Value: ' . $name);
            } else {
                $error_no = 449;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_model() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $model_name = $this->input->post('model-name');
            $sub_category = $this->input->post('sub-category');
            $product = $this->input->post('product');
            $description = $this->input->post('description');
            $display_price_original = $this->input->post('display-price-original');
            $display_price_sale = $this->input->post('display-price-sale');
            if ($this->Itemmodel->add_model($model_name, $sub_category, $product, $description, $display_price_original, $display_price_sale, $_SESSION['admin']['id'])) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Model', 'Name: ' . $model_name);
            } else {
                $error_no = 449;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_model() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $model_id = $this->input->post('model-id');
            $model_name = $this->input->post('model-name');
            $sub_category = $this->input->post('sub-category');
            $description = $this->input->post('description');
            $display_price_original = $this->input->post('display-price-original');
            $display_price_sale = $this->input->post('display-price-sale');
            if ($this->Itemmodel->edit_model($model_id, $model_name, $sub_category, $description, $display_price_original, $display_price_sale, $_SESSION['admin']['id'])) {
                Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Model', 'Name: ' . $model_name);
            } else {
                $error_no = 449;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_model_field_value() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $info['model_field_id'] = $this->input->post('model-field-id');
            $info['value'] = $this->input->post('value');
            $info['dispaly_order'] = $this->input->post('order-id');
            if ($this->Itemmodel->add_model_field_value($info, $_SESSION['admin']['id'])) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Model Field Value', 'Value: ' . $info['value']);
            } else {
                $error_no = 561;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_model_field_value() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $value_id = $this->input->post('id');
            $value = $this->input->post('value');
            $dispaly_order = $this->input->post('order_id');
            if (strlen(trim($value_id)) > 0 && strlen(trim($value)) > 0 && strlen(trim($dispaly_order)) > 0) {
                if ($this->Itemmodel->edit_model_field_value($value_id, $value, $dispaly_order, $_SESSION['admin']['id'])) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Model Field Value', 'Value: ' . $value);
                } else {
                    $error_no = 563;
                }
            } else {
                $error_no = 9;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_field_value() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $field_id = $this->input->post('field-id');
            $value = $this->input->post('value');
            if (!$this->Itemmodel->is_field_value_existing($field_id, $value)) {
                if ($this->Itemmodel->add_field_value($field_id, $value, $_SESSION['admin']['id'])) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Field Value', 'Value: ' . $value);
                } else {
                    $error_no = 561;
                }
            } else {
                $error_no = 10;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_field_value() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $value_id = $this->input->post('value-id');
            $value = $this->input->post('value');
            if (strlen(trim($value_id)) > 0 && strlen(trim($value)) > 0) {
                if ($this->Itemmodel->edit_field_value($value_id, $value, $_SESSION['admin']['id'])) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Field Value', 'Value: ' . $value);
                } else {
                    $error_no = 563;
                }
            } else {
                $error_no = 9;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function metadata_product_fields($id) {
        if (isset($_SESSION['admin'])) {
            if ($id != NULL && intval($id) > 0 && intval($id) < 9999) {
                $product = $this->Common->get_entity_by_id('metadata_product', $id);
                if ($product != FALSE) {
                    if ($product['enabled'] == 1) {
                        $data['product_data'] = $product;
                        $data['all_fields'] = $this->Common->get_all_fields();
                        $data['product_fields'] = $this->Product_model->get_fields_by_product($id);
                        $data['title'] = 'Admin | Product Fields';
                        $data['main_content'] = 'admin/product_fields';
                        $this->load->view('templates/admin_template', $data);
                    } else {
                        redirect(base_url('error/page/7'));
                    }
                } else {
                    redirect(base_url('error/page/8'));
                }
            } else {
                redirect(base_url('error/page/6'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function model_details($id) {
        if (isset($_SESSION['admin'])) {
            if ($id != NULL && intval($id) > 0 && intval($id) < 9999) {
                $model = $this->Common->get_entity_by_id('model', $id);
                if ($model != FALSE) {
                    if ($model['enabled'] == 1) {
                        $data['model'] = $model;
                        $data['model_fields'] = $this->Itemmodel->get_product_fields_by_model_id_backend($id);
                        $data['title'] = 'Admin | Models';
                        $data['main_content'] = 'admin/model_details';
                        $this->load->view('templates/admin_template', $data);
                    } else {
                        redirect(base_url('error/page/7'));
                    }
                } else {
                    redirect(base_url('error/page/8'));
                }
            } else {
                redirect(base_url('error/page/6'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_product_fields() {
        if (isset($_SESSION['admin'])) {
            $product_id = $this->input->post('product-id');
            $selected_fields = $this->input->post('selected_fields');
            if ($selected_fields != NULL && count($selected_fields) > 0) {
                $res = $this->Product_model->add_product_fields($product_id, $selected_fields, $_SESSION['admin']['id']);
                if ($res) {
                    redirect(base_url('item/metadata_product_fields/' . $product_id));
                } else {
                    
                }
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function product_field_display_inc($field_id) {
        if (isset($_SESSION['admin'])) {
            
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function product_field_display_dec($field_id) {
        if (isset($_SESSION['admin'])) {
            
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function update_model_field_values() {
        if (isset($_SESSION['admin'])) {
            $model_id = $this->input->post('model-id');
            $field_ids = $this->input->post('field-id');
            $field_values = $this->input->post('field-values');
            $values_array = [];
            if (count($field_ids) > 0) {
                $ok = TRUE;
                for ($i = 0; $i < count($field_ids); $i++) {
                    $field_id = $field_ids[$i];
                    $values = json_decode($field_values[$i], true);
                    $ok = $this->Itemmodel->update_model_field_values($field_id, $model_id, $values, $_SESSION['admin']['id']);
                    if ($ok == FALSE) {
                        break;
                    }
                }
                if ($ok) {
                    $_SESSION['message'] = ['id' => 567, 'message' => $this->config->item(567, 'msg')];
                    redirect(base_url('item/model_details/' . $model_id));
                } else {
                    redirect(base_url('error/page/566'));
                }
            } else {
                $_SESSION['message'] = ['id' => 567, 'message' => $this->config->item(567, 'msg')];
                redirect(base_url('item/model_details/' . $model_id));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function items() {
        if (isset($_SESSION['admin'])) {
            $data['models'] = $data['models'] = $this->Itemmodel->get_all_models(1);
            $data['items'] = $this->Itemmodel->get_all_items();
            $data['title'] = 'Admin | Items';
            $data['main_content'] = 'admin/items';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Items', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_item_view($model_id = NULL) {
        if (isset($_SESSION['admin'])) {
            if ($model_id != NULL && intval($model_id) > 0 && intval($model_id) < 999999) {
                $model_id = intval($model_id);
                $model = $this->Itemmodel->get_model_by_id($model_id, NULL);
                if ($model != FALSE) {
                    $data['model'] = $model;
                    $data['category_tree'] = $this->Category_model->get_category_by_subcategory($model['sub_category']);
                    $data['model_fields'] = $this->Itemmodel->get_product_fields_by_model_id($model['id']);
                    $data['units'] = $this->Itemmodel->all_item_units(1);
                    $data['title'] = 'Admin | Add Item';
                    $data['main_content'] = 'admin/add_item';
                    Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Add Item', '');
                    $this->load->view('templates/admin_template', $data);
                } else {
                    redirect(base_url('error/page/576')); //model not found
                }
            } else {
                redirect(base_url('error/page/575')); //invalid model id
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_item_next() {
        if (isset($_SESSION['admin'])) {
            $data['title'] = 'Admin | Add Item Images';
            $data['main_content'] = 'admin/add_item_next';
            $parameters = $this->Itemmodel->get_add_item_parameters();
            $data['parameters'] = $parameters;
            $_SESSION['item_add_parameters'] = $parameters;
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Add Item Next', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_item_save() {
        if (isset($_SESSION['admin'])) {
            if (isset($_SESSION['item_add_parameters'])) {
                $res = $this->Itemmodel->add_item($_SESSION['item_add_parameters'], $this->input->post('file-name'), $_SESSION['admin']['id']);
                if ($res != FALSE) {
                    unset($_SESSION['item_add_parameters']);
                    Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Add Item', 'ID : ' . $res);
                    $this->session->set_flashdata('message', [577, $this->config->item(577, 'msg')]);
                    redirect(base_url('item/items'));
                } else {
                    redirect(base_url('error/page/566')); //error while adding item
                }
            } else {
                redirect(base_url('error/page/12')); //session parameters not set 
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function edit_item_view($item_id) {
        if (isset($_SESSION['admin'])) {
            if ($item_id != NULL && intval($item_id) > 0 && intval($item_id) < 999999) {
                $item_id = intval($item_id);
                $item = $this->Itemmodel->get_item_by_id($item_id);
                if ($item != FALSE) {
                    $data['item'] = $item;
                    $data['category_tree'] = $this->Category_model->get_category_by_subcategory($item['sub_category']);
                    $data['model_fields'] = $this->Itemmodel->get_product_fields_by_model_id($item['model_id']);
                    $data['units'] = $this->Itemmodel->all_item_units(1);
                    $data['title'] = 'Admin | Edit Item';
                    $data['main_content'] = 'admin/edit_item';
                    Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Add Item', '');
                    $this->load->view('templates/admin_template', $data);
                } else {
                    redirect(base_url('error/page/576')); //model not found
                }
            } else {
                redirect(base_url('error/page/575')); //invalid model id
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function edit_item_save() {
        if (isset($_SESSION['admin'])) {
            $parameters = $this->Itemmodel->get_add_item_parameters();
            $parameters['item-id'] = $this->input->post('item-id');
            $res = $this->Itemmodel->edit_item($parameters, $_SESSION['admin']['id']);
            if ($res != FALSE) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Edit Item', 'ID : ' . $parameters['item-id']);
                $this->session->set_flashdata('message', [578, $this->config->item(578, 'msg')]);
                redirect(base_url('item/items'));
            } else {
                redirect(base_url('error/page/571')); //error while updating item
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function grn() {
        if (isset($_SESSION['admin'])) {
            $data['grns'] = $this->Itemmodel->get_all_grns();
            $data['title'] = 'Admin | GRN';
            $data['main_content'] = 'admin/grn';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Items', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_grn_view() {
        if (isset($_SESSION['admin'])) {
            $data['suppliers'] = $this->Product_model->get_all_suppliers(1);
            $data['categories'] = $this->Category_model->get_all_categories(1);
            $data['items'] = $this->Itemmodel->get_all_items(1);
            $data['branches'] = $this->Branch_model->get_all_branches(1);
            $data['search_item_html'] = $this->load->view('admin/includes/search_item', $data, TRUE);
            $data['title'] = 'Admin | GRN';
            $data['main_content'] = 'admin/add_grn';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Items', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function search_item_by_code() {
        $error_no = 0;
        $error = '';
        $item = null;
        if (isset($_SESSION['admin'])) {
            $item_code = $this->input->post('item-code');
            if ($item_code != NULL) {
                $item_code = trim($item_code);
                if (strlen($item_code) > 0 && strlen($item_code) < 25) {
                    Item::AddAuditTrailEntry(AUDITTRAIL_SEARCH, 'Item', 'Item ID: ' + $item_code);
                    $item = $this->Itemmodel->get_item_by_item_code($item_code);
                    if ($item == FALSE) {
                        $error_no = 603;
                    }
                } else {
                    $error = 602;
                }
            } else {
                $error = 602;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error, 'item' => [
                'id' => $item['id'],
                'name' => $item['name'],
                'code' => $item['code'],
                'model_name' => $item['model_name'],
                'description' => $item['description'],
                'counting_behaviour' => $item['counting_behaviour']
        ]));
    }

    public function add_grn() {
        if (isset($_SESSION['admin'])) {
            $grn_data = $this->Itemmodel->get_grn_data();
            $grn_items = $this->Itemmodel->get_grn_items();
            $res = $this->Itemmodel->add_grn($grn_data, $grn_items, $_SESSION['admin']['id']);
            if ($res != FALSE) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Grn', 'ID : ' . $res);
                $this->session->set_flashdata('message', [607, $this->config->item(607, 'msg')]);
                redirect(base_url('item/grn'));
            } else {
                redirect(base_url('error/page/608')); //error while adding grn
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function check_item_code() {
        $item_code = $this->input->post('item-code');
        $res = $this->Itemmodel->is_item_code_exists(trim($item_code));
        header('Content-Type: application/json');
        echo json_encode(['existing' => $res]);
    }

    public function item_details($item_id = NULL) {
        if (isset($_SESSION['admin'])) {
            if ($item_id != NULL) {
                $item = $this->Itemmodel->get_item_by_id($item_id);
                if ($item != NULL) {
                    $data['item'] = $item;
                    $data['grn_history'] = $this->Itemmodel->get_grn_history_by_item_id($item['id']);
                    $data['image_path'] = $this->Itemmodel->get_single_item_image($item['id']);
                    $data['title'] = 'Admin | Item Details';
                    $data['main_content'] = 'admin/item_view';
                    Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Item', '');
                    $this->load->view('templates/admin_template', $data);
                } else {
                    redirect(base_url('error/page/8')); //item not found                    
                }
            } else {
                redirect(base_url('error/page/8')); //item id not found
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function item_images($item_id = NULL) {
        if (isset($_SESSION['admin'])) {
            if ($item_id != NULL) {
                $item = $this->Itemmodel->get_item_by_id($item_id);
                if ($item != NULL) {
                    $data['item'] = $item;
                    $data['images'] = $this->Itemmodel->get_item_images_by_item_id($item['id']);
                    $data['title'] = 'Admin | Item Images';
                    $data['main_content'] = 'admin/item_images';
                    Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Item Images', '');
                    $this->load->view('templates/admin_template', $data);
                } else {
                    redirect(base_url('error/page/8')); //item not found                    
                }
            } else {
                redirect(base_url('error/page/8')); //item id not found
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function model_images($model_id = NULL) {
        if (isset($_SESSION['admin'])) {
            if ($model_id != NULL) {
                $model = $this->Itemmodel->get_model_by_id($model_id, NULL);
                if ($model != NULL) {
                    $data['model'] = $model;
                    $data['images'] = $this->Itemmodel->get_model_images_by_model_id($model['id']);
                    $data['title'] = 'Admin | Model Images';
                    $data['main_content'] = 'admin/model_images';
                    Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Item Images', '');
                    $this->load->view('templates/admin_template', $data);
                } else {
                    redirect(base_url('error/page/8')); //item not found                    
                }
            } else {
                redirect(base_url('error/page/8')); //item id not found
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function grn_details($grn_id = NULL) {
        if (isset($_SESSION['admin'])) {
            if ($grn_id != NULL) {
                $grn = $this->Itemmodel->get_grn_by_id($grn_id);
                if ($grn != FALSE) {
                    $data['grn'] = $grn;
                    $data['title'] = 'Admin | GRN Details';
                    $data['main_content'] = 'admin/grn_view';
                    Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'GRN', 'ID : ' . $grn_id);
                    $this->load->view('templates/admin_template', $data);
                } else {
                    redirect(base_url('error/page/612')); //GRN not found
                }
            } else {
                redirect(base_url('error/page/6')); //invalid ID
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function update_item_images() {
        if (isset($_SESSION['admin'])) {
            $item_id = $this->input->post('item-id');
            if ($item_id != NULL) {
                $item = $this->Itemmodel->get_item_by_id($item_id);
                if ($item != FALSE) {
                    $images = $this->Itemmodel->get_post_images($item_id);
                    if (count($images) > 0) {
                        $res = $this->Itemmodel->update_images('item_image', $images, $_SESSION['admin']['id']);
                        if ($res != FALSE) {
                            Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Item Images', 'Item ID : ' . $item_id);
                            $this->session->set_flashdata('message', [1109, $this->config->item(1109, 'msg')]);
                            redirect(base_url('item/item_images/' . $item_id));
                        } else {
                            redirect(base_url('error/page/1108')); // error while uploading image
                        }
                    } else {
                        redirect(base_url('error/page/1107')); //no images to update
                    }
                } else {
                    redirect(base_url('error/page/612')); //GRN not found
                }
            } else {
                redirect(base_url('error/page/6')); //invalid ID
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function update_model_images() {
        if (isset($_SESSION['admin'])) {
            $model_id = $this->input->post('model-id');
            if ($model_id != NULL) {
                $item = $this->Itemmodel->get_model_by_id($model_id, NULL);
                if ($item != FALSE) {
                    $images = $this->Itemmodel->get_post_images($model_id, TRUE);
                    if (count($images) > 0) {
                        $res = $this->Itemmodel->update_model_images($images, $_SESSION['admin']['id']);
                        if ($res != FALSE) {
                            Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Model Image', 'Model ID : ' . $model_id);
                            $this->session->set_flashdata('message', [1109, $this->config->item(1109, 'msg')]);
                            redirect(base_url('item/model_images/' . $model_id));
                        } else {
                            redirect(base_url('error/page/1108')); // error while uploading image
                        }
                    } else {
                        redirect(base_url('error/page/1107')); //no images to update
                    }
                } else {
                    redirect(base_url('error/page/612')); //GRN not found
                }
            } else {
                redirect(base_url('error/page/6')); //invalid ID
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function pricing() {
        if (isset($_SESSION['admin'])) {
            $data['categories'] = $this->Category_model->get_all_categories(1);
            $data['items'] = $this->Itemmodel->get_all_items(1);
            $data['search_item_html'] = $this->load->view('admin/includes/search_item', $data, TRUE);
            $data['title'] = 'Admin | Item Pricing';
            $data['main_content'] = 'admin/pricing';
            Item::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'GRN', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function get_gr_batches() {
        $error_no = 0;
        $error = '';
        $batches = null;
        if (isset($_SESSION['admin'])) {
            $item_id = $this->input->get('item-id');
            if ($item_id != NULL && strlen(trim($item_id)) > 0) {
                $item_id = intval($item_id);
                if ($item_id > 0 && $item_id < 999999) {
                    $batches = $this->Itemmodel->get_grn_history_by_item_id($item_id);
                } else {
                    $error_no = 6; //invalid item id
                }
            } else {
                $error_no = 6; //invalid item id
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error, 'batches' => $batches), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    public function add_selling_price() {
        $error_no = 0;
        $error = '';
        $batches = null;
        if (isset($_SESSION['admin'])) {
            $grn_item_id = $this->input->post('grn-item-id');
            $item_id = $this->input->post('item-id');
            $e_date = $this->input->post('effective-date');
            $effective_date = date('Y-m-d', strtotime($e_date));
            if ($effective_date >= date('Y-m-d')) {
                $price = $this->input->post('price');
                $res = $this->Itemmodel->add_selling_price($grn_item_id, $item_id, $effective_date, $price, $_SESSION['admin']['id']);
            } else {
                $error_no = 653; //effective date cannot be passed date
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error, 'batches' => $batches), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    public function get_price_history() {
        $error_no = 0;
        $error = '';
        $history = null;
        if (isset($_SESSION['admin'])) {
            $grn_item_id = $this->input->get('grn-item-id');
            if ($grn_item_id != NULL && strlen(trim($grn_item_id)) > 0) {
                $grn_item_id = intval($grn_item_id);
                if ($grn_item_id > 0 && $grn_item_id < 999999) {
                    $history = $this->Itemmodel->get_price_history_by_grn_item_id($grn_item_id);
                } else {
                    $error_no = 6; //invalid item id
                }
            } else {
                $error_no = 6; //invalid item id
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error, 'history' => $history), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    public function model_field_select($id) {
        if (isset($_SESSION['admin'])) {
            if ($id != NULL && intval($id) > 0 && intval($id) < 9999) {
                $model = $this->Common->get_entity_by_id('model', $id);
                if ($model != FALSE) {
                    if ($model['enabled'] == 1) {
                        $data['model_data'] = $model;
                        $data['model_fields'] = $this->Itemmodel->get_model_fields($id);
                        $data['list_fields'] = $this->Itemmodel->get_list_type_fields(1);
                        $data['title'] = 'Admin | Model Fields';
                        $data['main_content'] = 'admin/model_field_select';
                        $this->load->view('templates/admin_template', $data);
                    } else {
                        redirect(base_url('error/page/7'));
                    }
                } else {
                    redirect(base_url('error/page/8'));
                }
            } else {
                redirect(base_url('error/page/6'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_model_field() {
        if (isset($_SESSION['admin'])) {
            $model_id = $this->input->post('model-id');
            $field_id = $this->input->post('field-id');
            $res = $this->Itemmodel->add_model_field($model_id, $field_id, $_SESSION['admin']['id']);
            if ($res) {
                Item::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Model Field', 'Model ID : ' . $model_id . ',Field ID : ' . $field_id);
                $this->session->set_flashdata('message', [585, $this->config->item(585, 'msg')]);
                redirect(base_url('item/model_field_select/' . $model_id));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function select_model_field_values() {
        if (isset($_SESSION['admin'])) {
            $model_id = $this->input->post('model-id');
            $model_fied_ids = $this->input->post('model-field-id');
            $model_fied_enabled = $this->input->post('model-field-enabled');
            $model_fied_values = $this->input->post('model-field-value');
            $res = $this->Itemmodel->select_model_field_values($model_fied_ids, $model_fied_enabled, $model_fied_values, $_SESSION['admin']['id']);
            if ($res) {
                Item::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Select Model Field Values', '');
                $this->session->set_flashdata('message', [586, $this->config->item(586, 'msg')]);
            } else {
                $this->session->set_flashdata('message', [587, $this->config->item(587, 'msg')]);
            }
            redirect(base_url('item/model_field_select/' . $model_id));
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

}
