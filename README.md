# Studiostarlight

This repository contains the static site for Studio Starlight. The site lives in the `site/` directory and can be served locally or deployed to Netlify.

## Viewing the site locally

You can use a simple HTTP server to preview the files. If you have Node.js installed, run:

```bash
npx serve site
```

## Building

Running `npm run build` will generate a `newsfeed.html` file and HTML versions of any Markdown posts found in `site/posts/`. The script uses the `marked` library to convert Markdown to HTML.


## Email to Blog Function

The site includes a Netlify function located in `netlify/functions/email-to-blog.js`.
It expects a POST request containing a JSON body with `subject` and `text` fields.
When triggered, the function commits the text as a Markdown file under
`site/posts/` in this repository using the GitHub API.
Each filename includes a timestamp to avoid collisions when multiple posts are
created on the same day.

To enable the function, set the following environment variables in your Netlify
project:

- `GITHUB_OWNER` – GitHub username or organization
- `GITHUB_REPO` – Repository name (without the owner)
- `GITHUB_TOKEN` – Personal access token with `repo` scope

Once configured, you can send an HTTP POST (for example via Mailgun webhook)
and the content will be added as a new post and trigger a site deploy.

## Gallery and Shop

The gallery page currently contains placeholder text. You can add your own images and update the page as needed.

The shop page is a basic product listing with placeholder buy links. Update the links to integrate your preferred payment provider.
