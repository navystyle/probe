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
가입 확인을 위해 브라우저에서 다음 주소를 열어 주세요:
";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "confirm_code", array()), "html", null, true);
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
가입 확인을 위해 브라우저에서 다음 주소를 열어 주세요:
{{ user.confirm_code }}", "emails/join-confirm.twig", "/home/vagrant/work/probe/templates/emails/join-confirm.twig");
    }
}
