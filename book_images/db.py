import mysql.connector

# Connect to the database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="lms"  # Replace with your database name
)

# Create a cursor object
cursor = db.cursor()

# Select all records from the books table
cursor.execute("SELECT book_id, image FROM books")

# Fetch all records
books = cursor.fetchall()

# Iterate through each record
for book in books:
    book_id, image_name = book
    # Find the last underscore index
    last_underscore_index = image_name.rfind('_')
    if last_underscore_index != -1:  # If underscore exists
        # Extract the new image name
        new_image_name = image_name[:last_underscore_index] + image_name[image_name.rfind('.'):]

        # Update the record in the database
        cursor.execute("UPDATE books SET image = %s WHERE book_id = %s", (new_image_name, book_id))
        db.commit()
        print(f"Image name for book_id {book_id} updated to {new_image_name}")
    else:
        print(f"No underscore found in image name for book_id {book_id}, skipping.")

# Close the cursor and database connection
cursor.close()
db.close()
