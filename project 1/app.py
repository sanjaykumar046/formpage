from flask import Flask, render_template
from flask_mysqldb import MySQL

app = Flask(__name__, template_folder="templates")

# ✅ Database Configuration
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''  
app.config['MYSQL_DB'] = 'user_db'

mysql = MySQL(app)

@app.route('/')
def index():
    try:
        cur = mysql.connection.cursor()
        cur.execute("SELECT * FROM users")  # ✅ Ensure 'users' table exists
        users = cur.fetchall()
        cur.close()
        return render_template('dashboard.html', users=users)

    except Exception as e:
        import traceback
        return f"Error: {traceback.format_exc()}"  # ✅ Shows full error details

if __name__ == '__main__':
    app.run(debug=True)
