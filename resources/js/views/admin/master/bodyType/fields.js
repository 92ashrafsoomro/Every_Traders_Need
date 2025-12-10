export default [
    {
        key: "first_name",
        label: "First Name",
        type: "text",
     
        col: 4,
    },
    {
        key: "last_name",
        label: "Body Type Title",
        type: "text",
        col: 4,
    },
    {
        key: "status",
        label: "Status",
        type: "select",
        options: [
            { label: "Active", value: 1 },
            { label: "Inactive", value: 0 },
        ],
      
        col: 4,
    },
    {
        key: "description",
        label: "Description",
        type: "textarea",
        required: false,
        col: 12,
    },

    // FILE UPLOAD
    {
        key: "image",
        label: "Body Image",
        type: "file",
        col: 4,
    }
    
];
