export default {
    data: () => ({
        tinymceApiKey:'m963ohe7ztwr5xb9eha6efojiqzzf5nx1bdvt2xs28gbaz59',
        tinymceInit:{
            height: 500,
            menubar: false,
            language:'ru',
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste code help wordcount"
            ],
            toolbar:
                "undo redo |image|code| formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat |fullscreen|preview",
            toolbar_sticky: true,
            image_uploadtab: true,
            images_upload_url: 'postAcceptor.php',
            images_upload_base_path: '/some/basepath',
            image_description: false,
            image_dimensions: false
        }
    })}
