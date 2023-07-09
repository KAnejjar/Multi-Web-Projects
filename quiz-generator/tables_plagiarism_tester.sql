create or replace table convenor(
	convenor_id int not null primary key AUTO_INCREMENT,
	name varchar(225),
	email varchar(225),
	password varchar(225)
);
create table student(
	student_id int not null primary key AUTO_INCREMENT,
	name varchar(225),
	email varchar(225),
	password varchar(225)
);
create  table course(
	course_id int not null primary key AUTO_INCREMENT,
	name varchar(225),
	description varchar(225),
	convenor int not null references convenor(convenor_id)
);
create table enrollement(
	enrollement_id int not null primary key AUTO_INCREMENT,
	course int not null references course(course_id),
	student int not null references student(student_id),
);
create table assignment(
	assignment_id int not null primary key AUTO_INCREMENT,
	course int not null references course(course_id),
	description varchar(225),
);
create table question(
	question_id int not null primary key AUTO_INCREMENT,
	assignment int not null references assignment(assignment_id),
	description varchar(225),
	choices varchar(225),
);
create table submission(
	submission_id int not null primary key AUTO_INCREMENT,
	student int not null references student(student_id),
	assignment int not null references assignment(assignment_id),
	file varchar(225),
);
create table response(
	response_id int not null primary key AUTO_INCREMENT,
	submission int not null references submission(submission_id),
	question int not null references question(question_id),
	response varchar(225),
);

insert into student values("Student1","Student1@gmail.com","Student1pws");
insert into convenor values("Convenor1","Convenor1@gmail.com","Convenor1pwd");
insert into course values("Course1","This is Course 1",1);
insert into enrollement values(1,1);
insert into assignment values(1,"This is the first assignment");


insert into question(assignment,description,choices) values(1,"Which operator has higher precedence in the following list", "Modulus, BitWise AND,Exponent,Comparison");
insert into question(assignment,description,choices) values(1,"The in operator is used to check if a value exists within an iterable object container such as a list. Evaluate to True if it finds a variable in the specified sequence and False otherwise.", "True, False");
insert into question(assignment,description,choices) values(1,"A string is immutable in Python?Every time when we modify the string, Python Always create a new String and assign a new string to that variable.", "True,False");
insert into question(assignment,description,choices) values(1,"What is the data type of print(type(10))", "Float, integer,int");

insert into question(assignment,description,choices) values(1,"What is the output of print(type({}) is set)", "True, False");
insert into question(assignment,description,choices) values(1,"What is the output of the following code : print(bool(0), bool(3.14159), bool(-3), bool(1.0+1j))", "False True False True,True True False True,True True False True, False True True True");
insert into question(assignment,description,choices) values(1,"In  Python 3, what is the output of type(range(5)). (What data type it will return).", "int,list,range,None");
insert into question(assignment,description,choices) values(1," What is the result of print(type([]) is list)", "True, False");
insert into question(assignment,description,choices) values(1," What is the data type of print(type(0xFF))", "number,hexint,hex,int");
insert into question(assignment,description,choices) values(1,"What is the output of the following number conversionz = complex(1.25)", "(1.25+0j),ValueError");

insert into question(assignment,description,choices) values(1,"What is the output of the following code : print(int(2.999))", "ValueError: invalid literal for int(),3,2");
insert into question(assignment,description,choices) values(1,"What is the type of the following variable x = -5j
", "int,complex,imaginary,real");
insert into question(assignment,description,choices) values(1,"Choose the correct function to get the ASCII code of a character", "char('char'),ord('char'),ascii('char')");
insert into question(assignment,description,choices) values(1,"Strings are immutable in Python, which means a string cannot be modified.", "False,True");
insert into question(assignment,description,choices) values(1,"Python does not support a character type; a single character is treated as strings of length one.", "True,False");
insert into question(assignment,description,choices) values(1,"Which method should I use to convert String 'welcome to the beautiful world of python' to 'Welcome To The Beautiful World Of Python'
", "capitalize(),title()");

insert into question(assignment,description,choices) values(1,"Choose the correct function to get the character from ASCII number", "ascii(number),char(number),chr(number)");
insert into question(assignment,description,choices) values(1,"Select true statements regarding the Python tuple", "We can remove the item from tuple but we cannot update items of the tuple,We cannot delete the tuple,We cannot remove the items from the tuple,We cannot update items of the tuple.
");
insert into question(assignment,description,choices) values(1,"str = 'PYnative'. Choose the correct function to pick a single character from a given string randomly", "random.sample(str),random.choice(str),random.get(str; 1)");
insert into question(assignment,description,choices) values(1, "To Generate a random secure integer number, select all the correct options.","random.SystemRandom().randint(),random.System.randint(),secrets.randbelow()");


insert into submission values(1,1,"This is the content of the file submited");

alter table question add programming_language varchar(225) not null default "py";
alter table question add type varchar(255) not null default "random";
alter table question add right_response int not null default 1; #the number of the right answer


#SELECT * FROM `question` WHERE type="generated" and programming_language="php";