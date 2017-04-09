### Vanhackathon 2017

### Challenge Description
The best performance indicator of a mobile application is the category ranking and overall ranking inside an app store. The main stores are Google Play and Apple App Store, and there are several sub categories inside those stores such as social networking, shopping, games etc.

Your challenge is to crawl the app stores to get 1. Overall Ranking (If exists) and 2. Category Ranking of a mobile app for the selected Country, once the user enters their app name or their store link of the app.

For example I have an Android mobile app named " My Talking Tom". There will be a basic user interface where I will enter my app name and get today's United States rankings as: Games Free = 36, Overall = 92.

Bonus: Get also app details: icon, screenshots, description.


### Our solution

You can try our app [here](https://storecrawler.ivmelo.me).

[UI/UX Design sheets](https://xd.adobe.com/view/d4395673-f191-4241-a43b-fa1dbb656717/).

Our solution is composed of two projects. The first one is a [web crawler](https://github.com/ivmelo/store-scrapper) library (PHP) that scraps data from the App Store and Google Play. The second one, is a web application (PHP, Laravel) that displays that data in a easy to understand way. You can see not only how the app ranks in the general and category charts, but you can also check a list of the top apps, browse apps, search and etc...

The heart of our application is a command `php artisan chart:update` which should be executed daily in order to update the charts. We went for this approach in order to reduce the response time for users, since the charts are updated once a day, we can place this command in the server's crontab and have it done automatically for us.

The command accepts some arguments: i.e. `php artisan chart:update --ios --paid`. You can define which store you want to crawl. If you don't provide any arguments, it will crawl the free apps of the App Store. You can execute this command multiple times passing different arguments to crawl several stores.

If the app the user is looking for is not listed in the charts (therefore, were not previously crawled), they can paste an URL from the App Store/Google Play to have it added to our database.

### Problem Limitations
Neither the App Store or Google Play provides public stats for the apps they sell. Therefore, we were limited to the app charts that they publish.

The app store has a chart with the top 100 free and paid apps. Google play store has a chart with the top 600 apps, but for simplicity reasons, we only crawled the first 100.

http://www.apple.com/itunes/charts/free-apps/
http://www.apple.com/itunes/charts/paid-apps/
https://play.google.com/store/apps/collection/topselling_free?hl=en
https://play.google.com/store/apps/collection/topselling_paid?hl=en

### Being creative.
Since we had limited ranking info, we had to be creative in order to get the category ranking for a determined app. We did that by counting how many apps of the same category appeared in the main ranking, and with that info, we counted in which position the current app appeared, thus, determining the ranking of the app for it's category.

### Time constraints
If we had more time, there are at least a handful of features that we would like do add. One of them is a line graph with history information for the app. That would require a few days to work correctly though, since we need to acquire the data over time.

Another interesting feature would be to crawl stores of different countries to compare prices, ranking positions, etc... For now, our app only crawls the US Google Play and App Store.

### Our team
- Ivanilson Melo: Full Stack Web Developer based in Natal, Brazil.
- Mateus Pinheiro: UI/UX Designer based in Natal, Brazil.

Our team originally had 4 people, but due to schedule problems, only two members were able to participate in this hackathon.

We hope you like our work. Thanks for your time.
