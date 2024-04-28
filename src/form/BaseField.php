<?php
    namespace Sksamassa\MyFramework\src\form;
    use Sksamassa\MyFramework\src\Model;

    abstract class BaseField {
        public Model $model;
        public string $attribute;

        public function __construct(Model $model, string $attribute)
        {
            $this -> model = $model;
            $this -> attribute = $attribute;
        }

        abstract public function renderInput(): string;

        public function __toString() {
            
            return sprintf('
                <div class="form-group mb-3">
                    <label>%s</label>
                    %s
                    <div class="invalid-feedback mb-3">
                        %s
                    </div>
                </div>
            ', $this -> model -> getLabel($this -> attribute), 
               $this -> renderInput(),
               $this -> model -> getFirstError($this -> attribute));
        }
    }