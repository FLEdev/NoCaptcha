<?php


namespace FLEdev\NoCaptcha\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;


use FLEdev\NoCaptcha\Validator\NoCaptchaValidator;

class NoCaptchaType extends AbstractType
{
    /**
     * Session Property
     *
     * @var SessionInterface
     */
    protected $session;


    /**
     * Translation Property
     *
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Options
     *
     * @var array
     */
    private $_options = array();


    /**
     * NoCaptchaType constructor.
     *
     * @param SessionInterface    $session    -
     * @param TranslatorInterface $translator -
     * @param Array               $options    -
     */
    public function __construct(
        SessionInterface $session,
        TranslatorInterface $translator,
        $options
    ) {
        $this->session = $session;
        $this->translator = $translator;
        $this->_options = $options;
    }

    /**
     * Form Builder
     *
     * @param FormBuilderInterface $builder - Builder Interface
     * @param array                $options - Options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $validator = new NoCaptchaValidator(
            $this->_options,
            $this->translator,
            $this->session,
            sprintf('gcb_%s', $builder->getForm()->getName())
        );

        $event = \Symfony\Component\HttpKernel\Kernel::VERSION >= 2.3 ? FormEvents::POST_SUBMIT : FormEvents::POST_BIND;
        $builder->addEventListener($event, array($validator, 'validate'));

        return;
    }

    /**
     * View builder
     *
     * @param FormView      $view    -
     * @param FormInterface $form    -
     * @param array         $options -
     *
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_merge(
            $view->vars,
            array(
                'key' => $this->_options['key'],
            )
        );
        return;
    }

    /**
     * Type Definition - config
     *
     * @param OptionsResolver $resolver -
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $this->_options['mapped'] = false;
        $resolver->setDefaults($this->_options);
        return;
    }

    /**
     * Block Prefix
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'no_captcha';
    }


    /**
     * Parent definition
     *
     * @return string
     */
    public function getParent()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\TextType';
    }

    /**
     * Impelled Method
     *
     * @param OptionsResolverInterface $resolver -
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return;
    }

    /**
     * Impelled Method
     *
     * @return void
     */
    public function getName()
    {
        return;
    }
}