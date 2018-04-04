# yii2-validation-rules
for yii2

It's a wrapper on a current rules in \yii\base\Model. 
See discussion: https://github.com/yiisoft/yii2/issues/16027

TODO: add tests.

Use ValidationRule.

```php
public function rules()
{
    return [
        ValidationRule::attributes(['foo', 'bar'])->required()->build(),
        ValidationRule::atribute('foo')->string()->min(6)->on(self::SCENARIO_DEFAULT)->build()
    ];
}
```