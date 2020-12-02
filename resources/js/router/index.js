import Home from '../views/Home'
import About from '../views/About'
import NotesCreate from '../views/notes/Create'
import NotesTable from '../views/notes/Table'
import NotesShow from '../views/notes/Show'
import NoteEdit from '../views/notes/Edit'

export default{
	mode: 'history',

	routes: [

		{
			path: '/',
			name: 'home',
			component: Home
		},
		{
			path: '/about',
			name: 'pages.about',
			component: About
		},
		{
			path: '/notes/create',
			name: 'notes.create',
			component: NotesCreate
		},
		{
			path: '/notes/table',
			name: 'notes.table',
			component: NotesTable
		},
		{
			path: '/notes/:noteSlug',
			name: 'notes.show',
			component: NotesShow
		},
		{
			path: '/notes/:noteSlug/edit',
			name: 'notes.edit',
			component: NoteEdit
		},
	]
}