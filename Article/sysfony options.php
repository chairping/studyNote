<?php
The problem

I am pretty sure this code sounds familiar to you:
$options = [
    'page' => isset($input['page']) ? $input['page'] : 1,
    'items' => isset($input['items']) ? $input['items'] : 10
];

Here, we want to have an array with options that come from the user (for example, from a RESTful API).
And if any of the required options is not present, we use default options.
For this, we need to check if it��s present and use the default value otherwise. All this boilerplate is difficult to read and very repetitive.

An alternative would be to use the array_replace function:
$options = array_replace([
    'page'  => 1,
    'items' => 10
], $input);

The array_replace function replaces elements from the second argument into the first one,
so if $input contains a different value for any of the options, it would be overwritten.

While this solution is good enough, the OptionsResolver component provides a few interesting features.
In addition to dealing with default values, it can validate and normalize the data.
Simple example

The previous example using OptionsResolver would look like this:
use Symfony\Component\OptionsResolver\OptionsResolver;

$resolver = new OptionsResolver();

$resolver->setDefaults([
    'page' => 1,
    'items' => 10
]);

$options = $resolver->resolve($input);

Once executed, $options will contain a plain array with two elements: ��page�� and ��items��.
If $input contains values for any of these values, they will be overwritten. Let��s see a few examples:
$input = []; // 'page' => 1, 'items' => 10
$input = ['page' => 2]; // 'page' => 2, 'items' => 10
$input = ['page' => 2, 'items' => 20]; // 'page' => 2, 'items' => 20
$input = ['other' => 5]; // UndefinedOptionsException

That��s right! If we try to use a value other than the ones defined, it throws an exception.
This would be the first advantage of using the component over array_replace, but there are more.

It is also possible to use a closure to set default parameters in case they depend on something else.
We can even set default parameters based on other parameters. For example, let��s add a third parameter, ��order��, and define the order randomly. You know�� improving UX :)
$resolver->setDefault('order', function (Options $options) {
    $orders = ['asc', 'desc'];

    return $orders[rand(0, 1)];
});

As you can see, the function receives an Options object, so we can use it to generate default values based on other parameters.
Imagine that we have also a ��order_by�� parameter, so we could set the order based on this:
$resolver->setDefault('order', function (Options $options) {
    if ('creation_date' === $options['order_by']) {
        return 'desc';
    }

    return 'asc';
});
Validation

We may want to validate input data, something more than necessary when dealing with user-provided data.
The component provides some ways to validate data by type or by value using the methods setAllowedTypes() and setAllowedValues().

With setAllowedTypes(), it is possible to restrict the value of the option to the given types.
For example, to restrict ��page�� values to integer values:
$resolver->setAllowedTypes('page', 'int');

It is also possible to allow more than one type:
$resolver->setAllowedTypes('page', ['int', 'float']);

What if we want to constrain the range of values that can be used? Using the method setAllowedValues() we can define a set of allowed values.
For example, to limit the possible values of ��items�� to 10, 20 or 40:
$resolver->setAllowedValues('items', [10, 20, 40]);

But setAllowedValues() is much more powerful, as it can receive a Closure. In the following example, we can validate that ��page�� is between 1 and 10:
$resolver->setAllowedValues('page', function($value) {
    return $value >= 1 && $value <=10;
});

If you read the post about the Validator component, you know that there is already a constraint to define ranges.
Integrating the validator component is really easy:
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Range;

$resolver->setAllowedValues('items', function($value) {
    $validator = Validation::createValidator();
    $constraint = new Range([
        'min' => 1,
        'max' => 10
    ]);

    $violations = $validator->validate($value, $constraint);

    return 0 === $violations->count();
});
Normalization

Finally, we can also normalize data before using the options with the setNormalizer() method.
It accepts a Closure that receives the value and the rest of options.
For example, we could normalize the ��page�� option in case that the value provided by the user is over the maximum number of pages:
$resolver->setNormalizer('page', function ($options, $value) use ($maxPage) {
    if ($value > $maxPage) {
        $value = $maxPage;
    }

    return $value;
});
