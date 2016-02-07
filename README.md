# KyrosBB

### Version: 0.5.0-dev

### Changelog
- 0.5-dev
 - **This version is unstable!**
 - Added hooks.
   - KyrosBB ships with one default hook file (`hooks/usersOnline.hook.php`).
     - This hook adds the "Online Users" block in the sidebar. To remove this block, simply remove this hook file.
- 0.4
 - Adds categories for posting, with a default category of "General Discussions"
 - Adds a permission system
   - Default permissions are for guests to view only, and members to post in all categories.  Once more functionality is added, a permission manager will be implemented to allow for more categories access control.
 - Adds an online user list to the sidebar.
 - Added functionality to log out once logged in.
 - Adds a registration script, so users don't have to manually be input.
 - Tags all topics with the appropriate topic starter.
 - Tags all posts with the appropriate post author.