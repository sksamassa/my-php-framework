<?php
    namespace Sksamassa\MyFramework\src;

    abstract class UserModel extends DBModel {
        abstract public function getDisplayName(): string;
    }