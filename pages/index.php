<?php

echo rex_view::title($this->getProperty('page')['title']);

$action = rex_get('action', 'string');
$form   = rex_config_form::factory('klogger');

$field = $form->addTextField('rollbar_access_token', null, ["class" => "form-control"]);
$field->setLabel('Rollbar Access token');

$formOutput = $form->get();

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('body', $formOutput, false);
echo $fragment->parse('core/page/section.php');
