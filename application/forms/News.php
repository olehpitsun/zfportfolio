<?php

class Form_News extends Zend_Form
{
    public function init()
    {
        $this->setName('index');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Заголовок')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,1000]] text-input form-control');

        $text = new Zend_Form_Element_Text('text');
        $text->setLabel('Текст')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,1000]] text-input form-control');

        $short_desc = new Zend_Form_Element_Text('short_desc');
        $short_desc->setLabel('Короткий зміст')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,500]] text-input form-control');

        $img_name = new Zend_Form_Element_Text('img_name');
        $img_name->setLabel('Картинка')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,500]] text-input form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary')
                ->setLabel('Додати');

        $this->addElements(array( $title, $text, $short_desc, $img_name, $submit));
        $this->setMethod('post');
    }
}

