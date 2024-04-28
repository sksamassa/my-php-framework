<?php
    namespace Sksamassa\MyFramework\src\form;
    // use Sksamassa\MyFramework\src\Model;

    class TextAreaField extends BaseField {
        
        public function renderInput(): string
        {
         return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>', 
                         $this -> attribute,
                         $this -> model -> hasError($this -> attribute) ? ' is-invalid' : '',
                         $this -> model -> {$this -> attribute}
                     );
        }
    }