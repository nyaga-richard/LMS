import os

# Directory containing the images
directory = 'C:/wamp64/www/LMS/book_images/'

# List all files in the directory
files = os.listdir(directory)

# Iterate through each file
for filename in files:
    # Check if the file is a regular file
    if os.path.isfile(os.path.join(directory, filename)):
        # Split the file name and extension
        name, extension = os.path.splitext(filename)
        # Find the last underscore index
        last_underscore_index = name.rfind('_')
        if last_underscore_index != -1:  # If underscore exists
            # Rename the file removing characters after the last underscore
            new_name = name[:last_underscore_index] + extension
            # Rename the file
            os.rename(os.path.join(directory, filename), os.path.join(directory, new_name))
            print(f'Renamed "{filename}" to "{new_name}"')
        else:
            print(f'No underscore found in "{filename}", skipping.')
