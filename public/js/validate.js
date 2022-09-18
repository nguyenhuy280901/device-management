$(function() {
    // Validate data form add equipment
    $(".form-equipment").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            status: {
                required: true,
                number: true
            },
            category_id: {
                required: true,
                number: true
            },
            approve_level: {
                required: true,
                number: true
            },
            description: {
                maxlength: 255
            },
            image_json: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please types device's name",
                maxlength: "The device's name is too long. Please truncates your device's name!"
            },
            status: {
                required: "Please choose device's status",
                number: "Invalid device's status"
            },
            category_id: {
                required: "Please choose category",
                number: "Invalid category"
            },
            approve_level: {
                required: "Please choose approve level",
                number: "Invalid approve level"
            },
            description: {
                maxlength: "The device's description is too long. Please truncates your device's description!"
            },
            image_json: {
                required: "Please choose image of device"
            }
        }
    });
    // Validate data form add category
    $(".form-category").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                maxlength: 255
            }
        },
        messages: {
            name: {
                required: "Please types category's name",
                maxlength: "The category's name is too long. Please truncates your category's name!"
            },
            description: {
                maxlength: "The category's description is too long. Please truncates category's description!"
            }
        }
    });

    // Validate data form add employee
    $(".form-employee").validate({
        rules: {
            fullname: {
                required: true,
                maxlength: 255
            },
            image_json: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                maxlength: 255,
                required: true
            },
            department_id: {
                required: true
            },
            role_id: {
                required: true
            }
        },
        messages: {
            fullname: {
                required: "Please types the fullname of employee",
                maxlength: "The fullname is too long. Please truncates the employee\'s fullname!"
            },
            image_json: {
                required: "PPlease choose image of employee"
            },
            email: {
                required: "Please types employee\'s email"
            },
            password: {
                maxlength: 'The password is too long. Please truncates the employee\'s password!',
                required: 'Please types the password of employee\'s account'
            },
            department_id: {
                required: 'Please choose the deparment that employee is working at'
            },
            role_id: {
                required: 'Please choose the employee\'s role'
            },
        }
    });

    // Validate data form add department
    $(".form-department").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                maxlength: 255
            }
        },
        messages: {
            name: {
                required: "Please types department's name",
                maxlength: "The department's name is too long. Please truncates your department's name!"
            },
            description: {
                maxlength: "The department's description is too long. Please truncates department's description!"
            }
        }
    });
})