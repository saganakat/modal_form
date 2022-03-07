<?php

namespace Drupal\modal_form\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ModalController extends ControllerBase {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilder
   */
  protected $formBuilder;

  /**
   * The ModalController constructor.
   *
   * @param \Drupal\Core\Form\FormBuilder $formBuilder
   *   The form builder.
   */
  public function __construct(FormBuilder $formBuilder) {
    $this->formBuilder = $formBuilder;
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The Drupal service container.
   *
   * @return \Drupal\modal_form\Controller\ModalController
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('form_builder')
    );
  }

  /**
   * Callback para abrir el form modal.
   */
  public function openModalForm(): AjaxResponse {
    $response = new AjaxResponse();

    // Obtiene el formulario modal usando el form builder.
    $modal_form = $this->formBuilder->getForm('Drupal\modal_form\Form\ModalForm');

    // Añade un comando AJAX para abrir la ventana modal con el formulario incluido.
    $response->addCommand(new OpenModalDialogCommand('Comienza algo grande', $modal_form, ['width' => '800']));

    return $response;
  }
}
