<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O :attribute field must be accepted.',
    'accepted_if' => 'O :attribute field must be accepted when :other is :value.',
    'active_url' => 'O :attribute campo precisa ser válido URL.',
    'after' => 'O :attribute field must be a date after :date.',
    'after_or_equal' => 'O :attribute field must be a date after or equal to :date.',
    'alpha' => 'O :attribute field must only contain letters.',
    'alpha_dash' => 'O :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'O :attribute field must only contain letters and numbers.',
    'array' => 'O :attribute field must be an array.',
    'ascii' => 'O :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'O :attribute field must be a date before :date.',
    'before_or_equal' => 'O :attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => 'O :attribute field must have between :min and :max items.',
        'file' => 'O :attribute field must be between :min and :max kilobytes.',
        'numeric' => 'O :attribute field must be between :min and :max.',
        'string' => 'O :attribute field must be between :min and :max characters.',
    ],
    'boolean' => 'O :attribute field must be true or false.',
    'can' => 'O :attribute field contains an unauthorized value.',
    'confirmed' => 'O :attribute field confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'O :attribute campo precisa ser válido date.',
    'date_equals' => 'O :attribute field must be a date equal to :date.',
    'date_format' => 'O :attribute field must match the format :format.',
    'decimal' => 'O :attribute field must have :decimal decimal places.',
    'declined' => 'O :attribute field must be declined.',
    'declined_if' => 'O :attribute field must be declined when :other is :value.',
    'different' => 'O :attribute field and :other must be different.',
    'digits' => 'O :attribute field must be :digits digits.',
    'digits_between' => 'O :attribute field must be between :min and :max digits.',
    'dimensions' => 'O :attribute field has invalid image dimensions.',
    'distinct' => 'O :attribute field has a duplicate value.',
    'doesnt_end_with' => 'O :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'O :attribute field must not start with one of the following: :values.',
    'email' => 'O :attribute campo precisa ser válido email address.',
    'ends_with' => 'O :attribute field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'extensions' => 'O :attribute field must have one of the following extensions: :values.',
    'file' => 'O :attribute field must be a file.',
    'filled' => 'O :attribute field must have a value.',
    'gt' => [
        'array' => 'O :attribute field must have more than :value items.',
        'file' => 'O :attribute field must be greater than :value kilobytes.',
        'numeric' => 'O :attribute field must be greater than :value.',
        'string' => 'O :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'O :attribute field must have :value items or more.',
        'file' => 'O :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'O :attribute field must be greater than or equal to :value.',
        'string' => 'O :attribute field must be greater than or equal to :value characters.',
    ],
    'hex_color' => 'O :attribute campo precisa ser válido hexadecimal color.',
    'image' => 'O :attribute field must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'O :attribute field must exist in :other.',
    'integer' => 'O :attribute field must be an integer.',
    'ip' => 'O :attribute campo precisa ser válido IP address.',
    'ipv4' => 'O :attribute campo precisa ser válido IPv4 address.',
    'ipv6' => 'O :attribute campo precisa ser válido IPv6 address.',
    'json' => 'O :attribute campo precisa ser válido JSON string.',
    'lowercase' => 'O :attribute field must be lowercase.',
    'lt' => [
        'array' => 'O :attribute field must have less than :value items.',
        'file' => 'O :attribute field must be less than :value kilobytes.',
        'numeric' => 'O :attribute field must be less than :value.',
        'string' => 'O :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'O :attribute field must not have more than :value items.',
        'file' => 'O :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'O :attribute field must be less than or equal to :value.',
        'string' => 'O :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'O :attribute campo precisa ser válido MAC address.',
    'max' => [
        'array' => 'O :attribute field must not have more than :max items.',
        'file' => 'O :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'O :attribute field must not be greater than :max.',
        'string' => 'O :attribute field must not be greater than :max characters.',
    ],
    'max_digits' => 'O :attribute field must not have more than :max digits.',
    'mimes' => 'O :attribute field must be a file of type: :values.',
    'mimetypes' => 'O :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'O :attribute field must have at least :min items.',
        'file' => 'O :attribute field must be at least :min kilobytes.',
        'numeric' => 'O :attribute field must be at least :min.',
        'string' => 'O :attribute field must be at least :min characters.',
    ],
    'min_digits' => 'O :attribute field must have at least :min digits.',
    'missing' => 'O :attribute field must be missing.',
    'missing_if' => 'O :attribute field must be missing when :other is :value.',
    'missing_unless' => 'O :attribute field must be missing unless :other is :value.',
    'missing_with' => 'O :attribute field must be missing when :values is present.',
    'missing_with_all' => 'O :attribute field must be missing when :values are present.',
    'multiple_of' => 'O :attribute field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'O :attribute field format is invalid.',
    'numeric' => 'O :attribute field must be a number.',
    'password' => [
        'letters' => 'O :attribute field must contain at least one letter.',
        'mixed' => 'O :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'O :attribute field must contain at least one number.',
        'symbols' => 'O :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'O :attribute field must be present.',
    'present_if' => 'O :attribute field must be present when :other is :value.',
    'present_unless' => 'O :attribute field must be present unless :other is :value.',
    'present_with' => 'O :attribute field must be present when :values is present.',
    'present_with_all' => 'O :attribute field must be present when :values are present.',
    'prohibited' => 'O :attribute field is prohibited.',
    'prohibited_if' => 'O :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'O :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'O :attribute field prohibits :other from being present.',
    'regex' => 'O :attribute field format is invalid.',
    'required' => 'O :attribute field is required.',
    'required_array_keys' => 'O :attribute field must contain entries for: :values.',
    'required_if' => 'O :attribute field is required when :other is :value.',
    'required_if_accepted' => 'O :attribute field is required when :other is accepted.',
    'required_unless' => 'O :attribute field is required unless :other is in :values.',
    'required_with' => 'O :attribute field is required when :values is present.',
    'required_with_all' => 'O :attribute field is required when :values are present.',
    'required_without' => 'O :attribute field is required when :values is not present.',
    'required_without_all' => 'O :attribute field is required when none of :values are present.',
    'same' => 'O :attribute field must match :other.',
    'size' => [
        'array' => 'O :attribute field must contain :size items.',
        'file' => 'O :attribute field must be :size kilobytes.',
        'numeric' => 'O :attribute field must be :size.',
        'string' => 'O :attribute field must be :size characters.',
    ],
    'starts_with' => 'O :attribute field must start with one of the following: :values.',
    'string' => 'O :attribute field must be a string.',
    'timezone' => 'O :attribute campo precisa ser válido timezone.',
    'unique' => 'O :attribute has already been taken.',
    'uploaded' => 'O :attribute failed to upload.',
    'uppercase' => 'O :attribute field must be uppercase.',
    'url' => 'O :attribute campo precisa ser válido URL.',
    'ulid' => 'O :attribute campo precisa ser válido ULID.',
    'uuid' => 'O :attribute campo precisa ser válido UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
