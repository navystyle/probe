<?php

/* login.twig */
class __TwigTemplate_3b62ab9cb2f7abdd03793869691481c9e432489942712f8b9d006723263e345c extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("login-layout.twig", "login.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "login-layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"row\">
    <div class=\"col-md-offset-4 col-md-4\">
        <p>
            <h3>Login</h3> <hr>
        </p>
        ";
        // line 9
        $this->loadTemplate("flash.twig", "login.twig", 9)->display($context);
        // line 10
        echo "        <form action=\"/login\" method=\"post\">
            <div class=\"form-group\">
                <input name=\"email\" type=\"text\" class=\"form-control\" id=\"exampleInputEmail1\" placeholder=\"Username\">
            </div>
            <div class=\"form-group\">
                <input name=\"password\" type=\"password\" class=\"form-control\" id=\"exampleInputPassword1\" placeholder=\"Password\">
            </div>
            <button type=\"submit\" class=\"btn btn-default login-button\">Login</button>
        </form>
        <br>
        Don't have account? <a href=\"/signup\">Signup</a>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 10,  42 => 9,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'login-layout.twig' %}

{% block content %}
<div class=\"row\">
    <div class=\"col-md-offset-4 col-md-4\">
        <p>
            <h3>Login</h3> <hr>
        </p>
        {% include \"flash.twig\" %}
        <form action=\"/login\" method=\"post\">
            <div class=\"form-group\">
                <input name=\"email\" type=\"text\" class=\"form-control\" id=\"exampleInputEmail1\" placeholder=\"Username\">
            </div>
            <div class=\"form-group\">
                <input name=\"password\" type=\"password\" class=\"form-control\" id=\"exampleInputPassword1\" placeholder=\"Password\">
            </div>
            <button type=\"submit\" class=\"btn btn-default login-button\">Login</button>
        </form>
        <br>
        Don't have account? <a href=\"/signup\">Signup</a>
    </div>
</div>
{% endblock %}", "login.twig", "/home/vagrant/work/tab/templates/login.twig");
    }
}
