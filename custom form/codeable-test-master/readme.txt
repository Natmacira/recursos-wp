=== Codeable Test ===
Contributors: josefinalucia086
Tags: forms
Requires at least: 5.6
Tested up to: 5.6
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This Plugin is a test project for Codeable. It registers two shortcodes ([codeable_test_form] and [codeable_test_entries]).

== Description ==

This is the long description.  No limit, and you can use Markdown (as well as in the following sections).

### User Manual for Codeable Test Plugin

#### Plugin Overview

The *Codeable Test Plugin* is a WordPress plugin designed as a test project. It provides two key functionalities via shortcodes:

- *[codeable_test_form]*: Displays a contact form for users to submit their details.
- *[codeable_test_entries]*: Displays a list of form entries submitted by users, with pagination and details view.

This plugin allows users to submit contact forms, while administrators can view the submitted entries and their details via the WordPress admin interface.

---

### Features

1. *Front-end Contact Form*  
   Displays a form for users to submit their first name, last name, email, subject, and message.
   
2. *Admin View*  
   Administrators can view submitted form entries on the backend in the form of posts (custom post type custom-form), with a meta box displaying the details of each entry.

3. *AJAX Submission*  
   Form submissions are processed using AJAX, allowing for a seamless user experience without page reloads.

4. *Pagination for Entries*  
   The plugin supports pagination for viewing multiple form entries, making it easy for administrators to manage large volumes of submissions.

5. *Shortcodes*  
   - [codeable_test_form]: Displays the front-end form.
   - [codeable_test_entries]: Displays the list of form entries (admin-only).

---

### Installation

1. *Install the Plugin*
   - Download the plugin ZIP file or upload it directly to your WordPress site through the *Plugins > Add New* section.
   - Activate the plugin.

2. *Create Form*
   - To display the form, insert the [codeable_test_form] shortcode into any page or post where you want the contact form to appear.

3. *View Entries*
   - To display the list of form entries, use the [codeable_test_entries] shortcode. This shortcode is only available to users with the *manage_options* capability (typically administrators).

---

### Usage

#### Front-end (Visitor)

1. *Contact Form Display*:  
   Visitors can access the form via any page or post containing the [codeable_test_form] shortcode. The form fields include:
   - *First Name* (required)
   - *Last Name* (required)
   - *Email* (required)
   - *Subject* (required)
   - *Message* (required)

2. *Form Submission*:  
   The form uses AJAX to submit data, meaning the page won’t reload after submission. After submission, visitors will see a confirmation message (e.g., "Thank you for sending us your feedback").

#### Back-end (Administrator)

1. *Viewing Entries*:  
   Form entries are stored as custom post types (custom-form). You can view these entries in the WordPress dashboard by navigating to *Posts > Custom Forms*. Entries are displayed in a table with the following columns:
   - *First Name*
   - *Last Name*
   - *Email*
   - *Subject*
   - *Actions* (View Details)

2. *Entry Details*:  
   When you click the *+* button under the *Actions* column, a detailed view of the form entry will appear, showing the complete submission data (first name, last name, email, subject, and message).

3. *Pagination*:  
   The list of form entries is paginated. You can navigate between pages using the pagination buttons that appear at the bottom of the entries list.

---

### Shortcodes

#### [codeable_test_form]

*Usage*:  
Place this shortcode anywhere on your WordPress site to display the front-end form.

[codeable_test_form]

*Attributes*:  
This shortcode does not require any attributes. It automatically displays the form when added to a page or post.

#### [codeable_test_entries]

*Usage*:  
Place this shortcode on an admin page or any page where you want to display the list of form entries. This shortcode will only be visible to administrators (those with *manage_options* capability).

[codeable_test_entries]

*Attributes*:  
- paged: The page number of the entries to display. Defaults to 1.

Example:
[codeable_test_entries paged="2"]

---

### How It Works

1. *Form Submission (AJAX)*:  
   When a visitor submits the form, the data is sent to the server using AJAX. The server processes the form data and inserts a new *custom-form* post into WordPress. Upon successful submission, the form will display a success message.

2. *Form Entry Storage*:  
   Each form entry is stored as a draft post of the custom-form post type. The form’s fields (first name, last name, email, subject, and message) are saved as post meta data, which is accessible from the WordPress admin dashboard.

3. *Backend Viewing*:  
   In the WordPress admin area, the plugin registers a custom meta box for each form entry. Administrators can view and edit these entries, and each post contains the form data submitted by the user.

4. *Pagination for Entries*:  
   The plugin supports pagination in the entry list. It limits the number of entries displayed per page and provides navigation buttons to move between pages.

---

### Frequently Asked Questions

#### 1. *How can I view the submitted form entries?*

Form entries are stored as *draft posts* in the custom-form post type. You can view them in your WordPress admin panel under *Posts > Custom Forms*.

#### 2. *Can I edit a form entry?*

Yes, administrators can edit form entries like any other post in WordPress. Simply click to edit the entry, and you will be able to modify the meta fields (first name, last name, email, etc.).

#### 3. *Can non-administrators submit the form?*

Yes, the form is designed for all visitors, and anyone can submit it. However, only users with the manage_options capability (typically administrators) can view the submitted entries.

#### 4. *Why can't I see the entries page?*

The entries page is only accessible to users with the manage_options capability. If you don’t have admin privileges, you won’t be able to view this page.

#### 5. *Can I change the form fields?*

The form fields (first name, last name, email, subject, message) are hardcoded into the plugin. To customize the form fields, you would need to modify the plugin’s code.

---

### Troubleshooting

- *Form Not Submitting*: If the form is not submitting, ensure that the JavaScript file is correctly enqueued and there are no JavaScript errors in the browser’s console. Check that the AJAX handler (admin-ajax.php) is working as expected.
- *Form Data Not Saving*: Ensure that your WordPress installation has write permissions for creating and updating posts. If the form data isn’t being stored, verify the server’s permissions.

---

### Conclusion

The *Codeable Test Plugin* is a simple yet effective tool for adding contact forms with AJAX submission capabilities to your WordPress site. It also provides an easy-to-use admin interface to view and manage the submitted form entries. By using the shortcodes [codeable_test_form] and [codeable_test_entries], you can enhance the functionality of your WordPress site while maintaining an easy-to-use backend interface.