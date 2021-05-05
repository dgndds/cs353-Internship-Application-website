import java.sql.*;

public class Driver{
    public static void main(String[] args){
        Connection con = null;

        try{
            con = DriverManager.getConnection("jdbc:mysql://url","username","password");
        }catch(Exception e){
            e.printStackTrace();
        }
        if(con != null){
            System.out.println("Connection Succesfull");
        }else{
            System.out.println("Connection Failed...");
        }

        Statement statement;

        try {
            statement = con.createStatement();
            statement.executeUpdate("DROP TABLE IF EXISTS apply;");
            statement.executeUpdate("DROP TABLE IF EXISTS company;");
            statement.executeUpdate("DROP TABLE IF EXISTS student;");

            statement.executeUpdate("CREATE TABLE student(" +
                    "sid CHAR(12), "+
                    "sname VARCHAR(50), " +
                    "bdate DATE, " +
                    "address VARCHAR(50), " +
                    "scity CHAR(20), " +
                    "year CHAR(20), " +
                    "gpa FLOAT, " +
                    "nationality VARCHAR(20), " +
                    "PRIMARY KEY(sid)) " +
                    "ENGINE=innodb;"
            );

            statement.executeUpdate("CREATE TABLE company(" +
                    "cid CHAR(8), "+
                    "cname VARCHAR(20), " +
                    "quota INT, " +
                    "PRIMARY KEY(cid)) " +
                    "ENGINE=innodb;"
            );

            statement.executeUpdate("CREATE TABLE apply(" +
                    "sid CHAR(12), "+
                    "cid CHAR(8), " +
                    "PRIMARY KEY(sid,cid), " +
                    "FOREIGN KEY (cid) REFERENCES company(cid), " +
                    "FOREIGN KEY (sid) REFERENCES student(sid) ON DELETE CASCADE)" +
                    "ENGINE=innodb;"
            );

            System.out.println("Table created Successfully!");

            statement.executeUpdate("INSERT INTO student VALUES" +
                    "(21000001, 'John', '1999-05-14', 'Windy', 'Chicago', 'senior', '2.33','US'), " +
                    "(21000002, 'Ali', '2001-09-30', 'Nisantasi', 'Istanbul', 'junior', '3.26','TC'), " +
                    "(21000003, 'Veli', '2003-02-25', 'Nisantasi', 'Istanbul', 'freshman', '2.41','TC'),"+
                    "(21000004, 'Ayse', '2003-01-15', 'Tunali', 'Ankara', 'freshman', '2.55','TC')");

            statement.executeUpdate("INSERT INTO company VALUES" +
                    "('C101', 'microsoft', 2), " +
                    "('C102', 'merkez bankasi', 5)," +
                    "('C103', 'tai', 3)," +
                    "('C104', 'tubitak', 5)," +
                    "('C105', 'aselsan', 3)," +
                    "('C106', 'havelsan', 4)," +
                    "('C107', 'milsoft', 2)");

            statement.executeUpdate("INSERT INTO apply VALUES" +
                    "(21000001, 'C101'), " +
                    "(21000001, 'C102'), " +
                    "(21000001, 'C103'), " +
                    "(21000002, 'C101'), " +
                    "(21000002, 'C105'), " +
                    "(21000003, 'C104'), " +
                    "(21000003, 'C105'), " +
                    "(21000004, 'C107')");

            System.out.println("Values Inserted Successfully!");

            System.out.printf("%15s | %15s | %15s | %15s | %15s | %15s  | %15s | %15s%n","sid","sname","bdate","address","scity","year","gpa","nationality");
            ResultSet students = statement.executeQuery("SELECT * FROM student");


            while(students.next()){
                System.out.printf("%15s | %15s | %15s | %15s | %15s | %15s  | %15s | %15s%n",students.getString("sid"),students.getString("sname"),students.getString("bdate"),
                        students.getString("address"),students.getString("scity"),students.getString("year"),students.getString("gpa"),students.getString("nationality"));
            }

            System.out.println();
            System.out.printf("%15s | %15s | %15s%n","cid","cname","quota");
            ResultSet companies = statement.executeQuery("SELECT * FROM company");


            while(companies.next()){
                System.out.printf("%15s | %15s | %15s%n",companies.getString("cid"),companies.getString("cname"),companies.getString("quota"));
            }

            System.out.println();
            System.out.printf("%15s | %15s%n","sid","cid");
            ResultSet applies = statement.executeQuery("SELECT * FROM apply");


            while(applies.next()){
                System.out.printf("%15s | %15s%n",applies.getString("sid"), applies.getString("cid"));
            }
        }catch(Exception e){
            e.printStackTrace();
        }
    }
}