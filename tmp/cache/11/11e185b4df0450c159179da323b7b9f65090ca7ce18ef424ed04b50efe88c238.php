<?php

/* flash.twig */
class __TwigTemplate_908c76cfe2ff77a406b86ff70384ee9186a6c857fc0839002f2a7b9e7ceeda52 extends Twig_Template
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
        if ((twig_get_attribute($this->env, $this->source, ($context["flash"] ?? null), "error", array()) || twig_get_attribute($this->env, $this->source, ($context["flash"] ?? null), "info", array()))) {
            // line 2
            echo "    <div id=\"alerts\">
        ";
            // line 3
            if (twig_get_attribute($this->env, $this->source, ($context["flash"] ?? null), "error", array())) {
                // line 4
                echo "            <div class=\"alert alert-danger\" style=\"text-align: center;\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                ";
                // line 6
                echo twig_get_attribute($this->env, $this->source, ($context["flash"] ?? null), "error", array());
                echo "
            </div>
        ";
            }
            // line 9
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, ($context["flash"] ?? null), "info", array())) {
                // line 10
                echo "            <div class=\"alert alert-info\" style=\"text-align: center;\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                ";
                // line 12
                echo twig_get_attribute($this->env, $this->source, ($context["flash"] ?? null), "info", array());
                echo "
            </div>
        ";
            }
            // line 15
            echo "    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "flash.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 15,  47 => 12,  43 => 10,  40 => 9,  34 => 6,  30 => 4,  28 => 3,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if flash.error or flash.info %}
    <div id=\"alerts\">
        {% if flash.error %}
            <div class=\"alert alert-danger\" style=\"text-align: center;\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                {{ flash.error | raw }}
            </div>
        {% endif %}
        {% if flash.info %}
            <div class=\"alert alert-info\" style=\"text-align: center;\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                {{ flash.info | raw }}
            </div>
        {% endif %}
    </div>
{% endif %}", "flash.twig", "/home/vagrant/work/tab/templates/flash.twig");
    }
}
