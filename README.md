# RegexGenerator

####Usage example:  
```
$regex = Expression::make()
  ->find('http')
  ->maybe('s')
  ->then('://')
  ->exclude('www')
  ->then('github.com');
```
