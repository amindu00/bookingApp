const initialBlogs = [
  { title: 'blog 1', author: 'writtenbyme', content: 'such empty' },
  { title: 'blog 2', author: 'he', content: 'nothing to see' },
  { title: 'blog 3', author: 'she', content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit delectus sapiente culpa. Enim fugit excepturi repellat mollitia, porro voluptatum voluptatem? Minus tempore ipsum magni necessitatibus numquam aut nihil quidem dolor.' }
]

const initialState = {
  authenticated: false,
  theme: 'cofee',
  blogs: initialBlogs,
  searchResults:[],
}

export { initialState };