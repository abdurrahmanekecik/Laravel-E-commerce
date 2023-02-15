<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    private string $label;
    private string $field;
    private string $placeholder;
    private string $value;

    /**
     * @param string $label
     * @param string $field
     * @param string $value
     * @param string $placeholder
     */
    public function __construct(string $label, string $field, string $placeholder,string $value="")
    {
        $this->label = $label;
        $this->field = $field;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea',[
                "label"=> $this->label,
                "field"=>$this->field,
                "placeholder"=>$this->placeholder,
                "value"=>$this->value
            ]
        );
    }
}
