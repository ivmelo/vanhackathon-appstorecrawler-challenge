### Vanhackathon 2017

### Challenge Description
The best performance indicator of a mobile application is the category ranking and overall ranking inside an app store. The main stores are Google Play and Apple App Store, and there are several sub categories inside those stores such as social networking, shopping, games etc.

Your challenge is to crawl the app stores to get 1. Overall Ranking (If exists) and 2. Category Ranking of a mobile app for the selected Country, once the user enters their app name or their store link of the app.

For example I have an Android mobile app named " My Talking Tom". There will be a basic user interface where I will enter my app name and get today's United States rankings as: Games Free = 36, Overall = 92.

Bonus: Get also app details: icon, screenshots, description.


### Our solution

You can try our app [here](https://storecrawler.ivmelo.me).

Our solution is composed of two projects. The first one is a [web crawler](https://github.com/ivmelo/store-scrapper) library that scraps data from the App Store and Google Play. The second one, is a web application that displays that data in a easy to understand way. You can see not only how the app ranks in the general and category charts, but you can also check a list of the top apps, browse apps, search and discover new apps.

The heart of our application is a command `php artisan chart:update` which should be executed daily in order to update the charts. We went for this approach in order to reduce the response time for users, since the charts are updated once a day, we can place this command in the server's crontab and have it done automatically for us.

The command accepts some arguments: i.e. `php artisan chart:update --ios --paid`. You MUST define which store you want to crawl. You can execute this command multiple times to crawl several stores.

If the app the user is looking for is not listed in the charts, they can paste an URL for the App Store/Google Play to have it added to our database. Which can later be updated automatically.

It's important to notice that all of the UI/UX design and code was made during the 48 hour period of the Hachathon.

### Problem Limitations
Neither the App Store or Google Play provides public stats for the apps they sell. Therefore, we were limited to the app charts that they publish.

The app store has a chart with the top 100 free and paid apps. Google play store has a chart with the top 600 apps, but for simplicity reasons, we only crawled the first 100.

### Being creative.
Since we had limited ranking info, we had to be crative in order to get the category ranking for a determined app. We did that by counting how many apps of the same category appeared in the main ranking, and with that info, we counted in which position the app appeared, thus, determining the ranking of the app for a given category.

### Time constraints
If we had more time, there are at least a handful of features that we would like do add. One of them is a graph with history information for the app. That would require a few days to work correctly though, since we need to acquire the data over time.

Another interesting feature would be to crawl stores of different countries to compare prices, ranking positions, etc... For now, our app only crawls the US Google Play and App Store.

### Our team
- Ivanilson Melo: Full Stack Web Developer based in Natal, Brazil.
- Mateus Pinheiro: UI/UX Designer based in Natal, Brazil.

Our team originally had 4 people, but due to schedule problems, only two members were able to participate in this hackathon.
