<?php
declare(strict_types=1);
namespace Controller;


use Core\AbstractControler;
use Helper\FormHelper;

class Security extends AbstractControler
{
    public function check(): void
    {
        $num1 = rand(1,10);
        $num2 = rand(1,10);

        echo $num1. '+'.$num2. '=';

        $form= new FormHelper();
        $form->input([
            'name' => 'answer',
            'placeholder' => 'atsakymas',
            'type' =>'number'
        ]);
        $form->input([
            'name'=>'submit',
            'value'=>'save'
        ]);
        $this->data['check'] = $form->getForm();

        $this->render('admin/check');
    }
}