async function fetchAndDisplayPosts() {
    const container = document.getElementById("posts-container"); // Target element

    try {
        // Fetch data from API
        const response = await fetch("https://jsonplaceholder.typicode.com/posts");
        const posts = await response.json();

        // Loop through data and create HTML elements
        posts.forEach((post) => {
            const postElement = document.createElement("div");
            postElement.innerHTML = `
                <h3>${post.title}</h3>
                <p>${post.body}</p>
            `;
            postElement.style.border = "1px solid #ccc";
            postElement.style.margin = "10px";
            postElement.style.padding = "10px";
            container.appendChild(postElement);
        });
    } catch (error) {
        console.error("Error fetching posts:", error);
        container.textContent = "Failed to load posts.";
    }
}

// Call the function to fetch and display posts
fetchAndDisplayPosts();
