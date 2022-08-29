# Statamic Buddy

Statamic addon for deploying a Buddy pipeline.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require itiden/statamic-buddy
```

## How to Use

You need to add the following variables to your `.env` file
```
STATAMIC_BUDDY_API_TOKEN=your-personal-access-token
STATAMIC_BUDDY_WORKSPACE="My workspace"
STATAMIC_BUDDY_PROJECT="My project"
STATAMIC_BUDDY_PIPELINE_ID=123456
```
