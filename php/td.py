#!/usr/bin/python

import nltk
from rake_nltk import Rake
import MySQLdb
import re
db=MySQLdb.connect(user="root",passwd="admin123",db="aprl",unix_socket="/run/mysqld/mysqld.sock")
cursor = db.cursor()
cursor.execute("SELECT description FROM blog ORDER BY date DESC LIMIT 1")
raw_html = cursor.fetchone()[0]
cleanr = re.compile('<.*?>')
text = re.sub(cleanr, '', raw_html)

r = Rake() 
r.extract_keywords_from_text(text)
l = r.get_ranked_phrases()
p = l[:min(len(l)/3,20)]
d = {}
for i in p:
    a = i.split(' ')
    for j in a:
        d[j] = 1
s = ""
for i in d:
    s += i
    s+= " "



try:
    # print text
    cursor.execute("UPDATE blog SET keywords = '%s' ORDER BY date DESC LIMIT 1" % s)
    db.commit()
    # print "updated in blog database"
except:
    pass

db.close()
# print r.get_ranked_phrases()[:10]



