import requests
from bs4 import BeautifulSoup
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np

baseurl = 'https://www.espn.com/mma/story/_/id/21807736/jorge-masvidal-douglas-lima-shake-welterweight-rankings'


# Spoof the user agent to change from Python to an actual browser user-agent to avoid being blocked
headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'
}

# possibly find and click on the cookie button as well
####

fighterlist = []


r = requests.get(
    'https://www.espn.com/mma/story/_/id/21807736/jorge-masvidal-douglas-lima-shake-welterweight-rankings')

soup = BeautifulSoup(r.content, 'lxml')

fightername = soup.find_all('div', class_='article-body')

smaller = soup.select('div h3')

# iterate through the fighter profile links, BUT send it into a list so I can use each index as a naviagiotn point for each one
# fighterlist = []

for fighter in smaller:
    for name in fighter.find_all('a', href=True):
        # print(name['href'])
        fighterlist.append(name['href'])

# print(fighterlist)

# go into each individual fighters page
finallist = []
for link in fighterlist:
    r = requests.get(link, headers=headers)
    soup = BeautifulSoup(r.content, 'lxml')

  # break it down to fighter stats box
    listteam = soup.find(
        'ul', class_='PlayerHeader__Bio_List flex flex-column list clr-gray-04')
# break it down again to fighter team name, which is 2nd in the <li> list [2]
# try block because some fighters have no teams
    try:
        team = listteam.find_all(
            'div', class_='fw-medium clr-black')[2].text.strip()
    except:
        team = 'team unknown'
# The first and last names were seperated, so I had to request them seperately then append them together
    try:
        firstname = soup.find(
            'span', class_='truncate min-w-0 fw-light').text.strip()
    except:
        firstname = 'none'
    try:
        lastname = soup.find('span', class_='truncate min-w-0').text.strip()
    except:
        lastname = 'none'
    # name = (firstname + lastname)
    # try block because some fighters have no records
    try:
        record = soup.find(
            'div', class_='StatBlockInner__Value tc fw-medium n2 clr-gray-02').text.strip()
    except:
        record = 'no record'
# turned into dictionary because it gives a good format
    profile = {
        'firstname': firstname,
        'lastname': lastname,
        'team': team,
        'record': record
    }

    finallist.append(profile)
    #print('Saving: ', profile['lastname'])
    #print(profile['lastname'])


df = pd.DataFrame(finallist)
df.to_csv('C:\\Users\\Nqwri\\Desktop\\coding\\PythonWebScraping\\Profile.csv',
          encoding='utf-8', index=False)
print(df.head(10))
df.describe()
