-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `A_Email` varchar(50) NOT NULL,
  `A_Password` varchar(255) NOT NULL,
  `A_Username` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `A_Email`, `A_Password`, `A_Username`) VALUES
(1, 'admin@gmail.com', '$2y$10$PG9xCXR3TNMGIgZb.m588uwQPqCNLpmNVBc6eWKy6F9ik6zM7oXWq', 'admin123'),
(24, 'test@gmail.com', '$2y$10$CWWr2nmQpESHQcpmKGLRX.gcx/tW5zU3PyGgw/F6Cy27A/ljGwkhS', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `Chapter_ID` int(11) NOT NULL,
  `Description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`Chapter_ID`, `Description`) VALUES
(1, 'This chapter discusses the operating system, a critical system software that functions as a manager, overseeing and coordinating the activities and resources of the computer. Acting as an interface between user programs and the computer system, the operating system ensures smooth interaction and efficient operation. There are various classifications of operating systems, including multi-user, single-user, real-time, batch, multitasking, and multiprogramming, each serving different purposes and environments.'),
(2, 'This chapter distinguishes and compares different types of user interfaces. It explores various user interfaces, highlighting their unique characteristics and functionalities, and evaluates their effectiveness in facilitating user interaction with computer systems.'),
(3, 'This chapter explains the importance of CPU scheduling, essential for optimizing process execution and system performance. It distinguishes between preemptive algorithms, which interrupt processes, and non-preemptive algorithms, which run processes to completion. It also covers calculating waiting time and turnaround time for processes.'),
(4, 'This chapter defines the term deadlock, identifies conditions that cause deadlocks, and explores methods for handling and preventing deadlocks.'),
(5, 'This chapter defines memory management concepts, explains single tasking with overlay, differentiates between fixed and variable partitioning, and distinguishes between internal and external fragmentation.'),
(6, 'This chapter defines virtual memory as a memory management technique that enables the execution of programs larger than physical memory by utilizing disk storage as an extension of RAM. It differentiates between demand paging, where pages are loaded from disk into memory only when they are demanded by the program, and demand segmentation, which loads segments of a program into memory as they are required during execution.'),
(7, 'This chapter defines page fault as the event where a requested page is not present in main memory and must be loaded from secondary storage. It explains how page faults occur when a process tries to access a page that is currently not resident in RAM. Additionally, it defines page replacement as the mechanism used to select and evict pages from memory when space is needed for new pages. The chapter suggests various methods for page replacement, which are algorithms designed to determine which pages to replace to optimize memory utilization and minimize page faults.'),
(8, 'This chapter explains how page replacement algorithms work by managing the eviction of pages from main memory to make space for new pages. These algorithms aim to optimize performance by minimizing the number of page faults. It defines thrashing as a state where the system is excessively busy swapping pages in and out of memory, severely impacting performance. Thrashing occurs when the system spends more time swapping pages than executing actual processes, often due to insufficient physical memory or poorly tuned paging algorithms.'),
(9, 'This chapter explores the function of disk scheduling, which is crucial for optimizing the access and utilization of disk storage resources in a computer system. Disk scheduling algorithms work by determining the order in which read and write requests are serviced from the disks queue of pending operations. These algorithms aim to minimize seek time and maximize throughput by efficiently organizing and prioritizing disk access requests.'),
(10, 'This chapter defines the basic components of a CPU, including the Arithmetic Logic Unit (ALU), Control Unit (CU), and registers, and explains their roles in executing instructions and performing calculations. It differentiates between the ALU and CU, highlighting their respective functions in handling arithmetic and logical operations and coordinating instruction execution within the CPU. The chapter defines registers as small, fast storage locations within the CPU used to store data temporarily during processing. Additionally, it explores how the Banker’s Algorithm works to prevent deadlock by ensuring safe allocation of resources and finding safe execution sequences for processes.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_ID` int(11) NOT NULL,
  `Rating` int(1) NOT NULL,
  `Reviews` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_ID`, `Rating`, `Reviews`) VALUES
(1, 5, 'This gamified e-learning platform is fantastic! The interactive challenges keep me engaged, and I\'ve learned so much more compared to traditional methods.'),
(2, 3, 'The concept is good and the content is helpful, but the website can be slow at times. Fixing the performance issues would make it much better.'),
(3, 2, 'While the idea is promising, the execution is lacking. There are too many bugs, and it\'s frustrating to use at times.'),
(4, 1, 'Very disappointing experience. The games are glitchy and the content is not as in-depth as I expected. Needs a lot of improvement.'),
(5, 4, 'Great website with fun and educational games. Some levels are a bit too challenging, but overall it\'s a wonderful learning experience.'),
(6, 4, 'very good'),
(7, 4, 'very good'),
(8, 3, '1123'),
(9, 3, '123'),
(10, 1, 'bad'),
(14, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `Guardian_ID` int(11) NOT NULL,
  `G_Email` varchar(50) NOT NULL,
  `G_Password` varchar(255) DEFAULT NULL,
  `G_Contact_Number` varchar(50) NOT NULL,
  `G_Username` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`Guardian_ID`, `G_Email`, `G_Password`, `G_Contact_Number`, `G_Username`) VALUES
(16, 'junkit@gmail.com', '$2y$10$n94TZYnbZUR5fif4K.gNK.HtuM7ggsluh3oCFRV/Xr3bZ5cF/3wai', '01293858494', 'jk'),
(17, 'xiangzheng@gmail.com', '$2y$10$YuvkMGGwyH/uVH6wJ.iwBudlBTzm0vGngyvTn/5LUYXQ5V5IJWAp.', '01842932923', 'xz'),
(18, 'test@gmail.com', '$2y$10$oIO3ZLncvC.njWLRk.tXnuAKg8/bfpmwW9wSHbtSPclJc9xIvTXOW', '123', 'guardian_test');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `Lecturer_ID` int(11) NOT NULL,
  `L_Username` varchar(50) NOT NULL,
  `L_Email` varchar(50) NOT NULL,
  `L_Password` varchar(255) DEFAULT NULL,
  `L_Contact_Number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`Lecturer_ID`, `L_Username`, `L_Email`, `L_Password`, `L_Contact_Number`) VALUES
(8, 'justin', 'justin@gmail.com', '$2y$10$H3Y3CrsBYharcQ/0F/fghuJirhVxZX/JGOWXC39wzv08FAO9LkPsq', '0123232323'),
(9, 'hongyu', 'hongyu@gmail.com', '$2y$10$idm/Vc/hJzHRdmm45mPOGubFgThKYEEIMoNDgpQ/50LmMAxoH.PiW', '019283283923'),
(10, 'lecturer_test', 'test@gmail.com', '$2y$10$pbTS02LVDEnXJcdPEkJoKu/PNZnj034gvsgwWY1vowiua2y0Fmijy', '123');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `Notes_ID` int(11) NOT NULL,
  `Notes_Name` varchar(200) NOT NULL,
  `Content` text NOT NULL,
  `Chapter_ID` int(11) NOT NULL,
  `Student_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`Notes_ID`, `Notes_Name`, `Content`, `Chapter_ID`, `Student_ID`) VALUES
(15, 'test', '123', 1, 49),
(16, 'intro', 'Operating SYstems is cool!', 1, 49),
(17, '12', 'fgdf', 1, 49);

-- --------------------------------------------------------

--
-- Table structure for table `progression`
--

CREATE TABLE `progression` (
  `Progression_ID` int(11) NOT NULL,
  `Student_ID` int(11) NOT NULL,
  `Chapter_ID` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progression`
--

INSERT INTO `progression` (`Progression_ID`, `Student_ID`, `Chapter_ID`, `Score`, `Status`) VALUES
(6, 51, 2, 40, 'Complete'),
(7, 51, 1, 30, 'Complete'),
(16, 49, 8, 0, 'Complete'),
(19, 49, 2, 90, 'Complete'),
(22, 49, 1, 70, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `Question_ID` int(11) NOT NULL,
  `Question` varchar(2000) NOT NULL,
  `Chapter_ID` int(11) NOT NULL,
  `Answer` varchar(2000) NOT NULL,
  `Option_2` varchar(2000) NOT NULL,
  `Option_3` varchar(2000) NOT NULL,
  `Option_4` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Question_ID`, `Question`, `Chapter_ID`, `Answer`, `Option_2`, `Option_3`, `Option_4`) VALUES
(21, 'What can Single-user Systems do?', 1, 'supports one user at a time', 'supports one user at a specific time period', 'supports one user at a multiple-time', 'supports multi-user at a time'),
(22, 'Which of the following is responsible for managing and coordinating all the activities of the computer system?', 1, 'Operating system', 'BIOS', 'Compiler', 'Application software'),
(23, 'Which is the MOST important element in creating a User Interface (UI)?', 2, 'Navigation and ease of use', 'Graphics and animations', 'Color scheme and visual aesthetics', 'Text and typography'),
(24, 'What does Kernel do?', 1, 'Manages operations of computer and hardware.', 'Manage Operating System only', 'Manage the network of a computer only', 'Manage the system call in a computer'),
(25, 'Below are basic function of an OS EXCEPT...', 1, 'Provides specific services to the hardware and user programs', 'Manages resources of the computer effectively', 'Act as a system manager / resource manager', 'Accepts commands from the user'),
(26, 'Which of the following is NOT a type of operating system?', 1, 'Web-based', 'Batch', 'Time-sharing', 'Real-time'),
(27, 'Below are the services provided to users and programs by OS EXCEPT,', 1, 'Protection', 'Communication', 'Program Execution', 'Error Detection'),
(28, 'Which of the following is an example of a multi-user operating system?', 1, 'Linux Ubuntu Server', 'Windows 10 Home Edition', 'macOS Catalina', 'Android Jelly Bean'),
(29, '\"CPU scheduling routines for memory, input output devices, file storage to decide the best method to utilize the CPU\". This is refer to which services provided by the OS?', 1, 'Resources Allocation', 'Input-Output Operations', 'Program Execution', 'Error Detection'),
(30, 'If you are designing a specific OS for an industrial control systems, what classification of OS would that be?', 1, 'Real-time OS', 'Batch OS', 'Multitasking OS', 'Multiprogramming OS'),
(32, 'What is the function of System Call?', 1, 'used for communication between the operating system and the application programs', 'used for communication between the network systems and the application programs', 'used for communication between the operating system and the hardware devices', 'used for communication between the operating system and the network systems'),
(33, 'What is Multitasking Systems?', 1, 'can run more than one process at a time', 'can run one process at multiple time', 'can run one process at a time', 'can run more than one process at multiple time'),
(34, 'List any TWO (2) definition of operating system.', 1, 'intermediary program, resource allocator, resource manager, control program', 'kernel, file system, user interface', 'application software, system software', 'input-output management, memory management'),
(35, 'Provide ONE (1) example of operating systems.', 1, 'macOS, Windows, Linux, Unix, Ubuntu, Android, iOS', 'Microsoft Office, Adobe Photoshop, Google Chrome', 'Intel Processor, Samsung SSD', 'Java, C++, Python, JavaScript'),
(36, 'Which is the CORRECT definition for User Interface?', 2, 'An interface based on what you see when you look at your monitor; the collection of words, pictures, buttons and menus that lets you do things', 'A place where interaction takes place between the hardware and the application program', 'The invisible service provided by the operating system', 'A place where you can navigate mouse and it interacts with computer hardware'),
(37, 'Which of the following user interfaces allows users to interact with the operating system by directly manipulating graphical elements such as windows, icons, and menus?', 2, 'Graphical User Interface (GUI)', 'Augmented Reality Interface', 'Haptic Interface', 'Voice Recognition Interface'),
(38, 'What type of application interprets commands and executes them?', 2, 'Command interpreter', 'Command Translator', 'Command Executer', 'Command Prompt'),
(39, 'Which user interface is the simplest user-interactive?', 2, 'Command Line Interface', 'Menu Driven Interface', 'Graphical User Interface', 'Non of the above'),
(40, 'Below are examples of Command Line Interface EXCEPT', 2, 'IBM AS-400', 'MS-DOS', 'UNIX', 'LINUX'),
(41, 'Below are the type of user interfaces EXCEPT', 2, 'Graphical Menu', 'Command Line', 'Graphical User', 'Menu Driven'),
(42, 'Which of the following user interfaces provides a command-line environment for interacting with the operating system?', 2, 'Command-Line Interface (CLI)', 'Natural Language Interface (NLI)', 'Graphical User Interface (GUI)', 'Touchscreen Interface'),
(43, 'Which of the following user interfaces provides a command-line environment for interacting with the operating system?', 2, 'Command-Line Interface (CLI)', 'Natural Language Interface (NLI)', 'Graphical User Interface (GUI)', 'Touchscreen Interface'),
(45, 'When a program runs, _____________ is created.', 3, 'Process', 'Control unit', 'Task', 'Thread'),
(46, 'A ____________________ is tasked with choosing which process to run first from the ready queue.', 3, 'CPU scheduler', 'Memory Reader', 'File Storage Checker', 'Ready Queue'),
(47, 'What is the main purpose for scheduling?', 3, 'CPU is not idle', 'CPU is not busy', 'CPU needs to rest', 'CPU must be idle'),
(48, 'Which is NOT part of CPU scheduling process?', 3, 'Stationary', 'Running', 'Ready', 'Waiting'),
(49, 'Which is the aim or goal for CPU scheduling?', 3, 'Efficiency', 'Unfairness', 'Maximize response time', 'Minimize throughput'),
(51, 'What is the advantage of SJF algorithm?', 4, 'Minimum average waiting time', 'Minimize CPU utilization', 'Maximize turnaround time', 'Minimize throughput'),
(52, 'Which algorithm in CPU scheduling has the longest average waiting time?', 4, 'FIFO', 'Round Robin', 'Shortest Job First (SJF)', 'Priority'),
(53, 'The difficulty with SJF is to determine the ____________ of the next process.', 4, 'Length', 'Priority', 'Type', 'Arrival time'),
(54, '_________________ is a technique used to gradually increase the priority of a process.', 4, 'Aging', 'Starvation', 'Prioritization', 'Hungry'),
(55, 'In CPU scheduling, there are Ready Queue and CPU Queue (where the process is running). By default, what algorithm is used at the Ready Queue?', 4, 'Multilevel Feedback Queue', 'Priority', 'Multilevel Queue', 'FIFO'),
(56, 'Which one is NOT belongs to non-preemptive scheduling?', 4, 'Round Robin', 'Shortest Job First (SJF)', 'First Come First Serve (FCFS)', 'First In First Out (FIFO)'),
(57, 'What is the advantage of FIFO algorithm in non-preemptive scheduling?', 4, 'The simplest CPU scheduling', 'The hardest CPU scheduling', 'The longest CPU scheduling', 'The easiest CPU scheduling'),
(59, 'What is one method of deadlock prevention?', 5, 'Mutual Exclusion', 'Interleaving', 'Synchronization', 'Concurrency'),
(60, 'What is the condition of hold and wait in deadlock prevention?', 5, 'A process holding resources while waiting for additional resources', 'A process preempting resources from other processes', 'A process releasing all resources before requesting new ones', 'A process requesting resources in a random order'),
(61, 'What is the condition of no preemption in a deadlock situation?', 5, 'Resources cannot be preempted, a process can only release a resource after the process has completed', 'Multiple processes can use a resource at the same time', 'Processes can wait indefinitely for a resource', 'Processes can preempt resources from each other'),
(62, 'What is the condition of mutual exclusion in a deadlock situation?', 5, 'Only one process can use a resource at a time', 'Processes can preempt resources from each other', 'Multiple processes can use a resource at the same time', 'Processes can wait indefinitely for a resource'),
(63, 'What is one condition that must be held simultaneously in a deadlock situation?', 5, 'Mutual Exclusion', 'Circular Wait', 'No preemption', 'Hold and Wait'),
(64, 'What is the purpose of a deadlock detection algorithm?', 5, 'To examine the state of the system and determine if a deadlock has occurred', 'To prevent deadlocks from occurring', 'To break the deadlock by terminating all deadlocked processes', 'To inform the operator and let them deal with the deadlock manually'),
(65, 'What is the purpose of using algorithms to declare the maximum number of resources needed for each process?', 5, 'To declare the maximum number of resources needed', 'To allocate memory to each process', 'To determine the number of processes in the system', 'To decide which processes should wait or proceed'),
(66, 'Why is it important for the operating system to have information on resource requests and releases?', 5, 'To decide which processes should wait or proceed', 'To determine the number of processes in the system', 'To allocate memory to each process', 'To calculate the speed of the processor'),
(67, 'What is the purpose of resource preemption as a deadlock-breaking method?', 5, 'To preempt resources from processes until the deadlock cycle is broken', 'To inform the operator and let them deal with the deadlock manually', 'To break the deadlock by terminating all deadlocked processes', 'To prevent deadlocks from occurring'),
(68, 'What is circular wait in deadlock prevention?', 5, 'A process requests resources in a circular order', 'A process releases resources in an increasing order of enumeration', 'A process requests resources in an increasing order of enumeration', 'A process releases resources in a circular order'),
(69, 'What role does the operating system play in deciding which processes should wait or proceed?', 5, 'It decides which processes should wait or proceed', 'It determines the number of processes in the system', 'It calculates the speed of the processor', 'It allocates memory to each process'),
(70, 'What is the condition of hold and wait in a deadlock situation?', 5, 'A process must hold at least one resource and wait for additional resources held by another process', 'Processes can wait indefinitely for a resource', 'Processes can preempt resources from each other', 'Multiple processes can use a resource at the same time'),
(71, 'What are the possible recovery methods when a deadlock is detected?', 5, 'All of the above', 'Preempt resources from processes', 'Inform the operator to deal with the deadlock manually', 'Terminate all deadlocked processes'),
(72, 'What are the overheads incurred by deadlock detection and recovery?', 5, 'Losses from recovering from a deadlock', 'Preempting resources from processes', 'Terminating all deadlocked processes', 'Preventing deadlocks from occurring'),
(73, 'What is the condition of circular wait in a deadlock situation?', 5, 'A set of waiting processes exist, where each process is waiting for a resource that is held by another process within the set', 'Processes can wait indefinitely for a resource', 'Processes can preempt resources from each other', 'Multiple processes can use a resource at the same time'),
(74, 'What does mutual exclusion mean in the context of deadlock prevention?', 5, 'Allowing multiple processes to access a resource simultaneously', 'Preempting resources from a process', 'Allowing processes to share resources without restrictions', 'Restricting access to a resource to only one process at a time'),
(75, 'Which situation leads to Deadlock?', 5, 'P1 using Ra, P2 using Rb and both processes don\'t want to share their resources.', 'P1 not using Ra, P2 not using Rb', 'P1 using Ra, P2 not using Rb', 'P1 using Ra for 1 minute and then use Rb, P2 using Rb for 30 seconds and then release.'),
(76, 'A process must exist where it is holding at least one resource and is waiting to acquire additional resources that are currently being held by another process. Which condition does this statement fall in?', 5, 'Hold and Wait', 'Mutual Exclusion', 'Circular Wait', 'Non-preemption'),
(77, 'What does no preemption mean in deadlock prevention?', 5, 'A process cannot request new resources if it is already holding some', 'A process can request new resources without releasing the ones it currently holds', 'A process can preempt resources from other processes', 'A process must release all resources before requesting new ones'),
(78, 'What factors does the operating system consider when determining if a request can be satisfied or halted?', 5, 'The resources currently available, resources allocated, future request and releases for each process', 'The speed of the processor', 'The number of processes in the system', 'The amount of memory available in the system'),
(81, 'Below are the goals of memory management EXCEPT?', 6, 'To make it as challenging as possible for programs to find space to be loaded and executed', 'To maximize the usage of memory', 'To reduce memory waste', 'To make it as simple as possible for programs to find space to be loaded and executed'),
(82, 'Which of the unit below responsible to keep track of which parts of the memory are in use and which parts are not so that they can be deallocated?', 6, 'Memory manager', 'Random Access Memory', 'Virtual memory', 'Read-Only Memory'),
(83, 'A technique to allow for a process to be larger than the size of physical memory. What is this technique called?', 6, 'Virtual Memory', 'Single Tasking with Overlay', 'Variable Memory Partitioning', 'Fixed Memory Partitioning'),
(85, 'Why is virtual memory important?', 7, 'To enable multitasking and use large programs', 'To replace the need for physical memory', 'To increase the speed of data access', 'To reduce the cost of RAM'),
(86, 'What is the downside of relying too much on virtual memory?', 7, 'The computer slows down', 'New programs cannot be opened', 'Data is lost', 'The computer crashes'),
(87, 'What is the role of the memory management unit (MMU) in virtual memory?', 7, 'To translate virtual addresses into real addresses', 'To divide memory into sections or paging files', 'To improve computer performance', 'To store pages on a disk'),
(88, 'What is NOT the advantage of Demand Paging?', 7, 'Increases the need for physical memory', 'Decreases paging time', 'Avoids reading pages that will not be used', 'Decreases the need for physical memory'),
(89, 'What is Virtual Memory?', 7, 'Logical memory', 'Memory management unit', 'Main memory', 'Physical memory'),
(90, 'What is the role of the memory management unit (MMU) in virtual memory?', 7, 'To map logical addresses to physical addresses', 'To increase the amount of RAM in a computer', 'To manage the computer\'s hard drive', 'To store data in virtual memory'),
(91, 'What is Page Replacement?', 9, 'A technique used to free a frame', 'A method to replace a page from the virtual memory', 'An algorithm to check whether there\'s page fault or not', 'A process used to divide processes into pages'),
(92, 'Which algorithm of Page Replacement Algorithm is the simplest and easy to implement?', 9, 'FIFO', 'Optimal', 'RR', 'SJF'),
(93, 'FIFO suffers from this anomaly, something that is unexpected. What is the name of this anomaly?', 9, 'Belady', 'Melady', 'Bernoulli', 'Optimal'),
(96, 'Why is disk considered as secondary storage?', 10, 'it stores passive data', 'it stores active data', 'it has a large storage', 'it has the fastest speed'),
(97, 'Where is Track 0 located on a disk?', 10, 'At the center of disk', 'the innermost of track', 'Outer side of the disk', 'the outermost of track'),
(98, 'What are the criteria for disk drives?', 10, 'fast access time', 'slow access time', 'decrease disk bandwidth', 'increase disk bandwidth'),
(99, 'What is the use of magnetic tape?', 10, 'used for storage and backup of infrequently used data', 'used for storage of confidential data', 'used for storage movies and music data only', 'used for storage and backup of most used data'),
(100, 'What is the main difference between SCAN and LOOK algorithm', 10, 'SCAN moves back and forth, LOOK moves forth and back', 'SCAN and LOOK are similar, except SCAN serving a queue while LOOK doesn\'t service a queue', 'SCAN scans the whole queue and select the nearest one, LOOK scans the whole queue and service it according to arrival time', 'SCAN moves until end of the disk, LOOK moves until end of last request'),
(101, 'what is operating systems?', 1, 'os', '1', '2', '3');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `Quiz_ID` int(11) NOT NULL,
  `Quiz_Name` varchar(200) NOT NULL,
  `Chapter_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `S_Username` varchar(50) NOT NULL,
  `S_Email` varchar(50) NOT NULL,
  `S_Password` varchar(255) DEFAULT NULL,
  `S_Contact_Number` varchar(50) NOT NULL,
  `Guardian_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `S_Username`, `S_Email`, `S_Password`, `S_Contact_Number`, `Guardian_ID`) VALUES
(49, 'kangwei', 'kw@gmail.com', '$2y$10$IuUyc7dgLgmDrQ/7EDMpdeiG5oyh5u3O83gIDQmiA9iHNP1tulOr2', '01382923932', 16),
(50, 'chenwei', 'chenwei@gmail.com', '$2y$10$QpRdRCZyIB/NhwFZz1QUYuB3gEXzd/sU7lwwO2mE227OXIpZ7yz6i', '019238293293', 17),
(51, 'test123', 'test@gmail.com', '$2y$10$K5PGozW3aaUQuowxC0Pc8OnETKd3kInp4NWhiwq0lC8o3cor8GYaC', '123', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`Chapter_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`Guardian_ID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`Lecturer_ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`Notes_ID`),
  ADD KEY `Chapter_ID` (`Chapter_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `progression`
--
ALTER TABLE `progression`
  ADD PRIMARY KEY (`Progression_ID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Question_ID`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Quiz_ID`),
  ADD KEY `Chapter_ID` (`Chapter_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `Guardian_ID` (`Guardian_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `Chapter_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `Guardian_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `Lecturer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `Notes_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `progression`
--
ALTER TABLE `progression`
  MODIFY `Progression_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `Quiz_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`Chapter_ID`) REFERENCES `chapter` (`Chapter_ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Guardian_ID`) REFERENCES `guardian` (`Guardian_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
