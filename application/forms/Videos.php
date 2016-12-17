<?php

class Form_Videos extends Zend_Form
{
    public function init()
    {
        $this->setName('managevideos');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Заголовок')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,234]] text-input form-control');

        $href = new Zend_Form_Element_Text('href');
        $href->setLabel('Посилання на відео')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,1000]] text-input form-control');

        $img_title = new Zend_Form_Element_Text('img_title');
        $img_title->setLabel('Фото на заголовок')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,1000]] text-input form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary')
                ->setLabel('Додати');

        $this->addElements(array( $title, $href, $img_title, $submit));
        $this->setMethod('post');
    }
}

