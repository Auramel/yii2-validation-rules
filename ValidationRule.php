<?php

/**
 * Class ValidationBuilder
 * ```php
 * public function rules()
 * {
 *      return [
 *          ValidationRule::attributes('foo', 'bar')->required()->build(),
 *          ValidationRule::attribute('foo')->string()->skipOnEmpty(true)->on(self::SCENARIO_UPDATE)->build()
 *      ];
 * }
 * ```php
 * @method BooleanRule boolean()
 * @method CaptchaRule captcha()
 * @method CompareRule compare()
 * @method DateRule date()
 * @method DoubleRule double()
 * @method ExistRule exist()
 * @method FileRule file()
 * @method FilterRule filter()
 * @method ImageRule image()
 * @method IpRule ip()
 * @method InRule in()
 * @method IntegerRule integer()
 * @method MatchRule match()
 * @method NumberRule number()
 * @method RequiredValue required()
 * @method SafeRule safe()
 * @method StringRule string()
 * @method TrimRule trim()
 * @method UniqueRule unique()
 * @method UrlRule url()
 */
class ValidationRule
{
    /**
     * @param array $attributes
     * @return $this
     */
    public static function attributes(array $attributes): object
    {
        $object = new static();

        $object->attributes = $attributes;

        return $object;
    }

    /**
     * @param string $attribute
     * @return $this
     */
    public static function attribute(string $attribute): object
    {
        $object = new static();

        array_push($object->attributes, $attribute);

        return $object;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return $this
     */
    public function __call(string $name, array $arguments): object
    {
        if (isset($arguments[0])) {
            $name = [
                $name => $arguments[0]
            ];
        }

        array_push($this->rules, $name);

        return $this;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        $result = [];

        array_push($result, $this->attributes);

        foreach ($this->rules as $rule) {
            if (is_array($rule)) {
                $result[key($rule)] = array_shift($rule);
            } else {
                array_push($result, $rule);
            }
        }

        return $result;
    }

    /**
     * @param string|callable $value
     * @return BaseRule
     */
    public function custom($value): object
    {
        array_push($this->rules, $value);

        return $this;
    }

    /** @var array */
    private $attributes = [];

    /** @var array */
    private $rules = [];
}