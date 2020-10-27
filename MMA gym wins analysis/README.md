UFC fighter analysis ESPN web scrape

Question: Which MMA gym is the best in the world?

My prediction: AKA(American Kickboxing Academy)
Best gym based on win/loss ratio: City Kickboxing

My own insights proved me wrong and gave me the right answer.

A common misconception is that the best gyms have the "best" fighters, but what does this really mean? I believe the best gym has the highest win to loss ratio
out of all fighters that train at the gym.

My methods:

1) Web scraped the ESPN website to get the fighter name, team name, and win - loss - draw record of the fighters in the top 10 of their respective divisions.
2) Converted this raw data into a dataframe to be used with jupyter notebooks for data cleaning and analysis.
3) Cleaned the data by combining the first and last name, divided the win-loss-draw into only wins and losses separately.
4) Analysis was to simply calculate the win/loss ratio by dividing the win column by loss column
5) Created graphs for total combined win/loss ratio by gym and another graph with the ratio and wins and losses indiviudally by grouped by team.

