<?php

namespace LaravelEnso\VueDatatable\app\Classes\Template\Builders;

class Structure
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function build()
    {
        $this->computeRoutes();
        $this->setLengthMenu();
        $this->setDefaults();
    }

    private function computeRoutes()
    {
        $this->template->readPath = route($this->template->routePrefix . '.' . $this->template->readSuffix, [], false);
        $this->template->writePath = !is_null($this->template->writeSuffix)
            ? route($this->template->routePrefix . '.' . $this->template->writeSuffix, [], false)
            : null;
    }

    private function setLengthMenu()
    {
        if (!property_exists($this->template, 'lengthMenu')) {
            $this->template->lengthMenu = config('enso.datatables.lengthMenu');
        }
    }

    private function setDefaults()
    {
        $this->template->sort = false;
        $this->template->total = false;
        $this->template->enum = false;
        $this->template->labels = config('enso.datatables.labels');
        $this->template->boolean = (object) config('enso.datatables.boolean');
    }
}
