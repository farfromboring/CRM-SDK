# WebWiseUSA CRM SDK

This SDK allows you to quickly get up and running with your WebWiseUSA CRM integration.

## Dependencies

GuzzleHTTP, PHP 7.1+

## Prerequisites

A crm.webwiseusa.com account and API Key

## Installation

```
composer require farfromboring/crm-sdk
```

Create an environment variable for the API key and API version
```
WEBWISEUSA_CRM_API_KEY="enter_it_here"
WEBWISEUSA_CRM_API_VERSION=1
```

If you have multiple keys, you can switch between them either by providing them during instantiation of the Endpoint class, or by setting it globally:

```
$sdk = new UserEndpoint(); //uses default API key from the environment variables above
$sdk2 = new FormEndpoint(getenv('MY_SECOND_API_KEY'));
$sdk3 = new OrderEndpoint(getenv('MY_SECOND_API_KEY'));
//or
$sdk = new UserEndpoint();
Client::setAPIKeyGlobally(getenv('MY_SECOND_API_KEY'));
$sdk2 = new FormEndpoint(); //or FormEndpoint::create()
$sdk3 = new OrderEndpoint(); //or OrderEndpoint::create()
```

The same thing works for the API version
```
$sdk = new UserEndpoint(null, 2);
$sdk = new FormEndpoint(null, 2);
//or
Client::setAPIVersionGlobally(2);
$sdk = new UserEndpoint(); //or UserEndpoint::create()
$sdk = new FormEndpoint(); //or FormEndpoint::create()
```

You can also set both the key and the version at the same time globally
```
Client::setAPIKeyGlobally(getenv('MY_SECOND_API_KEY'), 2);
```

## Development/Sandbox

Just prepend your API key with "dev_" in order to enable sandbox mode.

Example:
```
WEBWISEUSA_CRM_API_KEY="dev_[api_key_here]"
```

## Usage

A sample of the addUser method:


```php
//instantiate the User and Company objects from the SharedObjects folder
$user = new User(); //or User::create()
$company = new Company(); //or Company::create()

//set values (generally from a user submitted form)
//it's a very good idea to perform your own validation on this data prior to setting it
$user->setFname($_POST['fname']);
$user->setLname($_POST['lname']);
$user->setEmail($_POST['email']);

$company->setName($_POST['company']);

$user->setCompany($company);

//instantiate the user endpoint 
$user_sdk = new UserEndpoint(); //or UserEndpoint::create()

//an exception will be thrown if anything other than a 200 is returned
//an updated User object is returned on success
$new_user = $user_sdk->addUser($user);
```


## Users

Users come in 3 flavors: 
1) Guest: They do not officially have an account in the system, but they are treated the same. They are identified by a token to group their submissions and actions. Upon login, the guest account will be merged with the user.
2) User: They are a full-fledged user with password.
3) Employee: Essentially the same as a User, but with the ability to differentiate, you can display things like the cost of products or administration features.

Any endpoint method that accepts/requires a $user_id accepts the ID of any of these users. $guest->getId() for instance.

You can create a Guest using information they provided on your Contact Us form (or any other form),
or as a totally blank anonymous Guest (like if someone adds a product to their cart)
```php
$guest = new Guest();
$guest->setFname('Bob');
$guest->setLname('Jenkins');
$guest->setEmail('bob@jenkins.com');

$guest = (new GuestEndpoint())->addGuest($guest);

//or

$guest = (new GuestEndpoint())->addGuest();
```