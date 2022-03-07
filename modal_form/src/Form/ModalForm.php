<?php

namespace Drupal\modal_form\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseDialogCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Url;

class ModalForm extends FormBase {

  /**
   * @inheritDoc
   */
  public function getFormId(): string {
    return 'custom_modal_form';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nombre completo'),
      '#placeholder' => $this->t('Nombre completo'),
      '#required' => TRUE,
      '#default_value' => "",
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => t('Email'),
      '#placeholder' => t('Email'),
      '#required' => TRUE,
      '#default_value' => "",
      '#size' => 20,
      '#maxlength' => 20,
    ];

    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Teléfono'),
      '#placeholder' => $this->t('Teléfono'),
      '#required' => TRUE,
      '#size' => 10,
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => t('Mensaje'),
      '#placeholder' => t('Mensaje'),
      '#required' => TRUE,
      '#default_value' => "",
      '#rows' => 4,
      '#cols' => 5,
      '#resizable' => 'none',
    ];

    $form['actions'] = ['#type' => 'actions'];

    $form['actions']['send'] = [
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
      '#attributes' => [
        'class' => [
          'use-ajax',
        ],
      ],
      '#ajax' => [
        'callback' => [$this, 'submitModalFormAjax'],
        'event' => 'click',
      ],
    ];

      // Añadimos la librería necesaria de Drupal para el Modal.
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    return $form;
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public function submitModalFormAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $response->addCommand(new CloseDialogCommand());
    return $response;

  }

}
