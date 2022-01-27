<?php

class FormHelper
{
    private $form;

    public function __construct($action, $method)
    {
        $this->form = '<form action="'.$action.'" method="'.$method.'">';
    }

    public function input($data) //ikeliam data su inputu ir pridedam viska ka apsirasem $data stringe index php
    {
        $this->form .= '<input ';
        foreach ($data as $attribute => $value) {
            $this->form .= $attribute.'="'.$value.'" ';
        }
        $this->form .= ' >';


    }


    public function textArea($name, $placeholder =""){ // sitoje vietoje kur ="" nustatome default value, todel indexe
                                                        // kai kviesim funkcija nebutina nurodyti antro argumento, kadangi
                                                        // jis bus by default
        $this->form .= '<textarea name="'.$name.'" >'.$placeholder.'</textarea>';
    }

    public function select($data)
    {
        $this->form .= '<select name="'.$data['name'].'">';
        foreach ($data['option'] as $key=>$option) {
            $this->form .= '<option value="'.$key.'">'.$option.'</option>';
        }
        $this->form .= '</select>';
    }


    public function getForm()
    {
        $this->form .= '</form>';
        return $this->form;
    }
}