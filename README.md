# PHP Vague Search API
This is a search helper class written for searching a list of keywords in a long String. The code comes from La Salle's site-level Twitter REST API integration, where a degree of vagueness is needed in order to make the most out of @LaSalle_Sports' user timeline. We're currently using this search helper to provide access to more than 1,000 users a day, so there shall be no performance concerns.

##To use
In your application, do a
```
require 'php-vaguesearch-api/Search.php';
```
And then, anywhere you'd want to use it,
```
$search = new Search();
```

##Gradient
The gradient provides the vagueness of the search. Not all keywords may be present in the given data, so that a maximum limit must be set in order to search. The gradient is given in percentile as an Integer, and later combined into the method.
