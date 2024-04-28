<?php   
    namespace Sksamassa\MyFramework\models;
    use Sksamassa\MyFramework\src\Model;

    class ContactForm extends Model {
        public string $subject = '';
        public string $body = '';
        public string $email = '';
        
        public function rules(): array {
            return [
                'subject' => [self::RULE_REQUIRED],
                'body' => [self::RULE_REQUIRED],
                'email' => [self::RULE_REQUIRED],
            ];
        }

        public function labels(): array {
            return [
                'subject' => 'Enter Your Subject',
                'body' => 'Body',
                'email' => 'Your Email',
            ];
        }

        public function send() {
            return true;
        }
    }