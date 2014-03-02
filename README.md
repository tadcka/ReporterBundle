ReporterBundle
==============

## Installation

### Step 1: Download TadckaReporterBundle using composer

Add TadckaReporterBundle in your composer.json:

```js
{
    "require": {
        "tadcka/reporter-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update tadcka/reporter-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Tadcka\AddressBundle\TadckaReporterBundle(),
    );
}
```

