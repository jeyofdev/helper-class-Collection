# A class that allows to manipulate an array simply

<a name="index_block"></a>

* [1. Initialize a new collection](#block1)
* [2. Set the values of an array](#block2)
* [3. Get the array](#block3)
* [4. Get the values of an array](#block4)
    * [4.1. Get all the values of an array](#block4.1)
    * [4.2. Get one value of an array](#block4.2)
* [5. Get the indexes of an array](#block5)
    * [5.1. Get the index corresponding to the given value of an array](#block5.1)
    * [5.2. Get all the indexes of an array](#block5.2)
    * [5.3. Get the first index of an array](#block5.3)
    * [5.4. Get the last index of an array](#block5.4)
* [6. Check if an index or a value of an array exists](#block6)
    * [6.1. Check if an index exists in an array](#block6.1)
    * [6.2. Check if a value exists in an array](#block6.2)
* [7. Use an object as an array](#block7)
    * [7.1. Use an object as an array](#block7.1)
    * [7.2. Execute a foreach loop on an object](#block7.2)
* [8. Extract datas](#block8)
    * [8.1. Extract data from an array and add the index and its value in a new array](#block8.1)
    * [8.2. Extract data from an array and add it in a new array](#block8.2)
    * [8.3. Extract a portion of an array](#block8.3)
    * [8.4. Extract the minimum value of an array](#block8.4)
    * [8.5. Extract the maximum value of an array](#block8.5)
* [9. Join array elements with a string](#block9)
* [10. sort datas](#block10)
    * [10.1. Sort an array alphabetically](#block10.1)
    * [10.2. Sort an array by reverse alphabetical order](#block10.2)
* [11. Delete an index of an array](#block11)
    * [11.1. Delete a given index of an array](#block11.1)
    * [11.2. Delete the first index of an array](#block11.2)
    * [11.3. Delete the last index of an array](#block11.3)
    * [11.4. Empty the contents of an array](#block11.4)
* [12. Reverse the order of the elements of an array](#block12)
* [13. Add elements to an array](#block13)
* [14. Execute a callback on the values of an array](#block14)
* [15. Filter the elements of an array](#block15)
* [16. Get the element number of an array](#block16)



<a name="block1"></a>
## 1. Initialize a new collection [↑](#index_block) 

The constructor of the class Collection takes an optional parameter an array

```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection();

// or 

$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "php", "javascript", "python", "html", "css", "java"
]);
```


<a name="block2"></a>
## 2. Set the values of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection();

$collection
    ->set("username", "john")
    ->set("note", 15);
```



<a name="block3"></a>
## 3. Get the array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "php", "javascript", "python", "html", "css", "java"
]);

$collection->getDatas(); // return ["php", "javascript", "python", "html", "css", "java"]
```



<a name="block4"></a>
## 4. Get the values of an array [↑](#index_block)


<a name="block4.1"></a>
### 4.1. Get all the values of an array [↑](#index_block) 

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("2"); // return [0 => "Emily", 1 => 13]
$collection->get("2")->get(); // return [0 => "Emily", 1 => 13]
```


<a name="block4.1"></a>
### 4.2. Get one value of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0.name"); // return "Jean"
// or
$collection->get("2")->get("name"); // return "Emily"
```



<a name="block5"></a>
## 5. Get the indexes of an array [↑](#index_block)


<a name="block5.1"></a>
### 5.1. Get the index corresponding to the given value of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0")->keys("Jean"); // return "name"
$collection->get("0")->keys("php"); // return "languages"
$collection->get("0")->keys("11"); // return "note"
```


<a name="block5.2"></a>
### 5.2. Get all the indexes of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0")->keys();  // return ["name", "languages", "note"]
```


<a name="block5.3"></a>
### 5.3. Get the first index of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0")->firstKey();  // return "name"
```


<a name="block5.4"></a>
### 5.4. Get the last index of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0")->lastKey();  // return "note"
```



<a name="block6"></a>
## 6. Check if an index or a value of an array exists [↑](#index_block)


<a name="block6.1"></a>
### 6.1. Check if an index exists in an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0")->has("language");  // return true
$collection->get("0")->has("user");  // return false
```


<a name="block6.2"></a>
### 6.2. Check if a value exists in an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$collection->get("0")->exist("Jean");  // return true
$collection->get("0")->exist("php");  // return true
$collection->get("0")->exist("html");  // return false
```



<a name="block7"></a>
## 7. Use an object as an array [↑](#index_block)


<a name="block7.1"></a>
### 7.1. Use an object as an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection();

$collection->datas["name"] = "john";  
$collection->datas["language"] = "php";
$collection->datas["note"] = "14";

dump($collection->getDatas()); // return ["name" => "john", "language" => "php", "note" => "14"]
```


<a name="block7.2"></a>
### 7.2. Execute a foreach loop on an object [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "language" => "php", "note" => "11"],
    ["name" => "Marc", "language" => "javascript", "note" => "15"],
    ["name" => "Emily", "language" => "python", "note" => "13"]
]);

$datas = [];
foreach ($collection->get("0") as $k => $v) {
    $datas[] = "$k = $v";
}
$datas = implode(", ", $datas); // return "name = Jean, language = php, note = 11"
```



<a name="block8"></a>
## 8. Extract datas [↑](#index_block)


<a name="block8.1"></a>
### 8.1. Extract data from an array and add the index and its value in a new array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => "11"],
    ["name" => "Marc", "note" => "15"],
    ["name" => "Emily", "note" => "13"]
]);

$collection->lists("name", "note")->getDatas(); // return ["Jean" => "11", "Marc" => "15", "Emily" => "13"]
```


<a name="block8.2"></a>
### 8.2. Extract data from an array and add it in a new array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => "11"],
    ["name" => "Marc", "note" => "15"],
    ["name" => "Emily", "note" => "13"]
]);

$collection->extract("name")->getDatas(); // return [0 => "Jean", 1 => "Marc", 2 => "Emily"]
```


<a name="block8.3"></a>
### 8.3. Extract a portion of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "php", "javascript", "python", "html", "css", "java"
]);

$collection->extractPart(2)->getDatas(); // return [0 => "python", 1 => "html", 2 => "css", 3 => "java"]
$collection->extractPart(-3, 2)->getDatas();  // return [0 => "html", 1 => "css"]
$collection->extractPart(0, 3)->getDatas(); // return [0 => "php", 1 => "javascript", 2 => "python"]
```


<a name="block8.4"></a>
### 8.4. Extract the minimum value of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => 11],
    ["name" => "Marc", "note" => 8],
    ["name" => "Emily", "note" => 13]
]);

$collection->extract("note")->min()); // return 8
// or
$collection->min("note")); // return 8
```


<a name="block8.5"></a>
### 8.5. Extract the maximum value of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => 11],
    ["name" => "Marc", "note" => 8],
    ["name" => "Emily", "note" => 13]
]);

$collection->extract("note")->max()); // return 13
// or
$collection->min("note")); // return 13
```



<a name="block9"></a>
## 9. Join array elements with a string [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => 11],
    ["name" => "Marc", "note" => 8],
    ["name" => "Emily", "note" => 13]
]);

$collection->extract("name")->join(", "))->getDatas(); // return "Jean, Marc, Emily"
```



<a name="block10"></a>
## 10. sort datas [↑](#index_block)


<a name="block10.1"></a>
### 10.1. Sort an array alphabetically [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => 11],
    ["name" => "Marc", "note" => 8],
    ["name" => "Emily", "note" => 13]
]);

$collection->extract("name")->sort()); // return "Emily, Jean, Marc"

// or

$collection->sort("name")); // return "Emily, Jean, Marc"
```


<a name="block10.2"></a>
### 10.2. Sort an array by reverse alphabetical order [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => 11],
    ["name" => "Marc", "note" => 8],
    ["name" => "Emily", "note" => 13]
]);

$collection->extract("name")->rsort()); // return "Marc, Jean, Emily"

// or

$collection->rsort("name")); // return "Marc, Jean, Emily"
```



<a name="block11"></a>
## 11. Delete an index of an array [↑](#index_block)


<a name="block11.1"></a>
### 11.1. Delete a given index of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "Marc", "Emily", "John"
]);

$collection->delete("1", "2")->getDatas(); // return [0 => "Jean", 3 => "John"]
```


<a name="block11.2"></a>
### 11.2. Delete the first index of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "Marc", "Emily", "John"
]);

$collection->deleteFirst()->getDatas(); // return [0 => "Marc", 1 => "Emily", 2 => "John"]
```


<a name="block11.3"></a>
### 11.3. Delete the last index of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "Marc", "Emily", "John"
]);

$collection->deleteLast()->getDatas(); // return [0 => "Jean", 1 => "Marc", 2 => "Emily"]
```


<a name="block11.4"></a>
### 11.4. Empty the contents of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "Marc", "Emily", "John"
]);

$collection->empty()->getDatas(); // return []
```

<a name="block12"></a>
## 12. Reverse the order of the elements of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "Marc", "Emily", "John"
]);

$collection->reverse()->getDatas(); // return [0 => "John", 1 => "Emily", 2 => "Marc", 3 => "Jean"]
```



<a name="block13"></a>
## 13. Add elements to an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "John"
]);

$collection->add("start", "Marc", "Emily")->getDatas(); // return [0 => "Marc", 1 => "Emily", 2 => "Jean", 3 => "John"]
$collection->add("end", "Marc", "Emily")->getDatas(); // return [0 => "Jean", 1 => "John", 2 => "Marc", 3 => "Emily"]
```



<a name="block14"></a>
## 14. Execute a callback on the values of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "Jean", "Marc", "Emily", "John"
]);

$collection->map(function ($datas) {
    return strtoupper($datas);
})->getDatas();

// return [0 => "JEAN", 1 => "MARC", 2 => "EMILY", 3 => "JOHN"]
```



<a name="block15"></a>
## 15. Filter the elements of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    ["name" => "Jean", "note" => 11],
    ["name" => "Marc", "note" => 8],
    ["name" => "Emily", "note" => 13]
]);

$datas = $collection->extract("note");
$collection->extract("note")->filter(function ($datas) {
    return ($datas >= 10) ? $datas : null;
})->getDatas();

// return [0 => 11, 2 => 13]
```




<a name="block16"></a>
## 16. Get the element number of an array [↑](#index_block)

#### Usage:
```php
$collection = new jeyofdev\Helper\ManipulateArray\Collection([
    "php", "javascript", "python", "html", "css", "java"
]);

$count = $collection->count();   // return 6
```