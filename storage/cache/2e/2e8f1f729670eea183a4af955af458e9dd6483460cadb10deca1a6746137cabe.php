<?php

/* emails/join-confirm.twig */
class __TwigTemplate_72b4550c75f883c64a7248ff8647214c9c465be3ce36a6a6a15ab60a81fbed55 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "name", array()), "html", null, true);
        echo "님, 환영합니다.
<br>가입 확인을 위해 아래 승인 버튼을 클릭해 주세요.
<br><a href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->extensions['Slim\Views\TwigExtension']->baseUrl(), "html", null, true);
        echo twig_escape_filter($this->env, $this->extensions['Slim\Views\TwigExtension']->pathFor("confirm", array("confirm_code" => twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "confirmCode", array()))), "html", null, true);
        echo "\">[승인]</a>";
    }

    public function getTemplateName()
    {
        return "emails/join-confirm.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 3,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{{ user.name }}님, 환영합니다.
<br>가입 확인을 위해 아래 승인 버튼을 클릭해 주세요.
<br><a href=\"{{ base_url() }}{{ path_for('confirm', { 'confirm_code': user.confirmCode }) }}\">[승인]</a>", "emails/join-confirm.twig", "/home/vagrant/work/probe/templates/emails/join-confirm.twig");
    }
}
