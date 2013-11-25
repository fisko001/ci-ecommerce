<?php

$config['admin_forms_validations'] = array(
			/*User update form validation*/
    		'users/edit' => array(
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'trim|required|xss_clean',
                                         ),
                                    array(
                                            'field' => 'first_name',
                                            'label' => 'First Name',
                                            'rules' => 'trim|required|xss_clean',
                                         ),
                                    array(
                                            'field' => 'last_name',
                                            'label' => 'Last Name',
                                            'rules' => 'trim|required|xss_clean',
                                         ),
                                   array(
                                            'field' => 'email',
                                            'label' => 'E-mail',
                                            'rules' => 'trim|required|valid_email',
                                         ),
                                    array(
                                            'field' => 'status',
                                            'label' => 'Status',
                                            'rules' => 'required|is_numeric',
                                         ),
                                   
                               ),
				/*Catgeory update form validation*/
              'categories/form' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'Title',
                                            'rules' => 'trim|required|max_length[64]',
                                         ),
                                    array(
                                            'field' => 'slug',
                                            'label' => 'Slug',
                                            'rules' => 'trim|required|xss_clean',
                                         ),
                                    array(
                                            'field' => 'description',
                                            'label' => 'Description',
                                            'rules' => 'trim',
                                         ),
                                    array(
                                            'field' => 'excerpt',
                                            'label' => 'Excerpt',
                                            'rules' => 'trim',
                                         ),
                                    array(
                                            'field' => 'sequence',
                                            'label' => 'Sequence',
                                            'rules' => 'trim|integer',
                                         ),
                                    array(
                                            'field' => 'parent_id',
                                            'label' => 'Parent',
                                            'rules' => 'trim',
                                         ),
                                    array(
                                            'field' => 'image',
                                            'label' => 'Image',
                                            'rules' => 'trim',
                                         ),
                                    array(
                                            'field' => 'seo_title',
                                            'label' => 'Seo Title',
                                            'rules' => 'trim',
                                         ),
									array(
                                            'field' => 'meta',
                                            'label' => 'Meta Description',
                                            'rules' => 'trim',
                                         ),
                               ),
    'companies/edit'    => array(
                                array(
                                    'field' => 'employer_types_id',
                                    'label' => 'Company Type',
                                    'rules' => 'required|is_numeric'
                                ),
                                array(
                                    'field' => 'entity_types_id',
                                    'label' => 'Entity Type',
                                    'rules' => 'is_numeric'
                                ),
                                array(
                                    'field' => 'name',
                                    'label' => 'Company Name',
                                    'rules' => 'required'
                                ),
                                array(
                                    'field' => 'domain_name',
                                    'label' => 'Domain Name',
                                    'rules' => 'required'
                                ),
                                ),
    'entities/edit'    => array(
                                array(
                                    'field' => 'entity_id',
                                    'label' => 'Entity',
                                    'rules' => 'required|is_numeric'
                                ),
                                array(
                                    'field' => 'billing_entity',
                                    'label' => 'Billing Entity',
                                    'rules' => 'required'
                                ),
                                array(
                                    'field' => 'billing_entity_abn',
                                    'label' => 'Billing Entity ABN',
                                    'rules' => 'required'
                                ),
                                array(
                                    'field' => 'billing_address_line1',
                                    'label' => 'Billing Entity Line 1',
                                    'rules' => 'required'
                                ),
                                /*array(
                                    field' => 'billing_address_line2',
                                    label' => 'Billing Entity Line 2',
                                    rules' => 'required'
                                ),*/
                                array(
                                    'field' => 'billing_address_suburb',
                                    'label' => 'Billing Entity Suburb',
                                    'rules' => 'required'
                                ),
                                array(
                                    'field' => 'billing_address_postcode',
                                    'label' => 'Billing Entity PostCode',
                                    'rules' => 'required'
                                ),
                                array(
                                    'field' => 'states_id',
                                    'label' => 'State',
                                    'rules' => 'required'
                                ),
//                                array(
//                                    'field' => 'rate',
//                                    'label' => 'Billing Rate',
//                                    'rules' => 'required'
//                                ),
//                                array(
//                                    'field' => 'gst_rate',
//                                    'label' => 'GST Rate',
//                                    'rules' => 'required|is_float'
//                                ),
                                ),
               );
